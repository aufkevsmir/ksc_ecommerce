<?php

class OrdersController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules()
	{
		return array(
			['allow', 'actions'=>['index','view'], 'users'=>['@']],
			['allow', 'actions'=>['create','update','cancel','checkout','seller','updateStatus'], 'users'=>['@']],
			['allow', 'actions'=>['admin','delete'], 'users'=>['admin']],
			['deny', 'users'=>['*']],
		);
	}

	public function actionView($id)
	{
		$order = Orders::model()->with([
			'orderItems.product',
			'seller',
			'transaction',
		])->findByPk($id);

		if (!$order) {
			throw new CHttpException(404, 'Order not found.');
		}

		$role = Yii::app()->user->getState('role');

		if (
			($role === 'buyer' && $order->buyer_id !== Yii::app()->user->id) ||
			($role === 'seller' && $order->seller->user_id !== Yii::app()->user->id)
		) {
			throw new CHttpException(403, 'Access denied.');
		}

		$this->render('view', ['order' => $order]);
	}

	public function actionCreate()
	{
		$model = new Orders;

		if (isset($_POST['Orders'])) {
			$model->attributes = $_POST['Orders'];
			if ($model->save())
				$this->redirect(['view', 'id' => $model->id]);
		}

		$this->render('create', ['model' => $model]);
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		if (isset($_POST['Orders'])) {
			$model->attributes = $_POST['Orders'];
			if ($model->save())
				$this->redirect(['view', 'id' => $model->id]);
		}

		$this->render('update', ['model' => $model]);
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
	}

	public function actionIndex()
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'buyer') {
			throw new CHttpException(403, 'Unauthorized');
		}

		$criteria = new CDbCriteria([
			'condition' => 'buyer_id = :uid',
			'params' => [':uid' => Yii::app()->user->id],
			'order' => 't.created_at DESC',
			'with' => ['orderItems.product', 'seller'],
		]);

		$dataProvider = new CActiveDataProvider('Orders', [
			'criteria' => $criteria,
			'pagination' => ['pageSize' => 5],
		]);

		$this->render('index', ['dataProvider' => $dataProvider]);
	}

	public function actionAdmin()
	{
		$model = new Orders('search');
		$model->unsetAttributes();
		if (isset($_GET['Orders'])) {
			$model->attributes = $_GET['Orders'];
		}
		$this->render('admin', ['model' => $model]);
	}

	public function loadModel($id)
	{
		$model = Orders::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'orders-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSeller()
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'seller') {
			throw new CHttpException(403, 'Only sellers can access this page.');
		}

		$company = Companies::model()->findByAttributes(['user_id' => Yii::app()->user->id]);
		if (!$company) {
			throw new CHttpException(404, 'Company not found.');
		}

		$dataProvider = new CActiveDataProvider('Orders', [
			'criteria' => [
				'condition' => 'seller_id = :sid',
				'params' => [':sid' => $company->id],
				'order' => 't.created_at DESC',
			],
			'pagination' => ['pageSize' => 10],
		]);

		$this->render('seller', ['dataProvider' => $dataProvider]);
	}

	public function actionUpdateStatus($id)
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'seller') {
			throw new CHttpException(403, 'Unauthorized');
		}

		$order = Orders::model()->findByPk($id);
		if (!$order || $order->seller->user_id != Yii::app()->user->id) {
			throw new CHttpException(403, 'Access denied.');
		}

		if (isset($_POST['status'])) {
			$order->status = $_POST['status'];
			if ($order->save()) {
				Yii::app()->user->setFlash('success', 'Order status updated.');
			}
			$this->redirect(['orders/seller']);
		}

		$this->render('update_status', ['order' => $order]);
	}

	public function actionCancel($id)
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'buyer') {
			throw new CHttpException(403, 'Unauthorized');
		}

		$order = Orders::model()->findByPk($id);
		if (!$order || $order->buyer_id != Yii::app()->user->id || $order->status !== 'pending') {
			throw new CHttpException(403, 'Order cannot be cancelled.');
		}

		$order->status = 'cancelled';
		if ($order->save()) {
			Yii::app()->user->setFlash('success', 'Order cancelled successfully.');
		}

		$this->redirect(['order/index']);
	}

	public function actionCheckout()
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'buyer') {
			$this->redirect(['site/login']);
		}

		$userId = Yii::app()->user->id;
		$cartItems = Cart::model()->findAllByAttributes(['user_id' => $userId]);

		if (empty($cartItems)) {
			Yii::app()->user->setFlash('error', 'Your cart is empty.');
			$this->redirect(['cart/index']);
		}

		$totalAmount = 0;
		foreach ($cartItems as $item) {
			$totalAmount += $item->quantity * $item->product->price;
		}

		if ($_POST) {
			require_once(dirname(__FILE__) . '/../../vendor/autoload.php');
			\Stripe\Stripe::setApiKey(Yii::app()->params['stripe_secret_key']);

			$token = $_POST['stripeToken'];

			try {
				$charge = \Stripe\Charge::create([
					'amount' => intval($totalAmount * 100),
					'currency' => 'usd',
					'source' => $token,
					'description' => "KSC Order for User ID {$userId}",
				]);

				$order = new Orders;
				$order->buyer_id = $userId;
				$order->seller_id = $cartItems[0]->product->company_id;
				$order->total_amount = $totalAmount;
				$order->status = 'paid';
				$order->created_at = new CDbExpression('NOW()');
				if ($order->save()) {
					foreach ($cartItems as $item) {
						$orderItem = new OrderItems;
						$orderItem->order_id = $order->id;
						$orderItem->product_id = $item->product_id;
						$orderItem->quantity = $item->quantity;
						$orderItem->price = $item->product->price;
						$orderItem->save();
					}

					$transaction = new Transactions;
					$transaction->order_id = $order->id;
					$transaction->payment_reference = $charge->id;
					$transaction->amount = $totalAmount;
					$transaction->payment_method = 'stripe';
					$transaction->paid_at = new CDbExpression('NOW()');
					$transaction->save();

					Cart::model()->deleteAllByAttributes(['user_id' => $userId]);

					$this->redirect(['order/success', 'id' => $order->id]);
				} else {
					Yii::app()->user->setFlash('error', 'Order saving failed.');
					$this->redirect(['cart/index']);
				}
			} catch (\Stripe\Exception\CardException $e) {
				Yii::app()->user->setFlash('error', 'Payment failed: ' . $e->getMessage());
				$this->redirect(['cart/index']);
			}
		}

		$this->render('checkout', ['totalAmount' => $totalAmount]);
	}
}