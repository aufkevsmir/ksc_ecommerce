<?php
class BuyerController extends Controller
{
	public function actionDashboard()
	{
		$this->render('dashboard');
	}

	public function actionOrders()
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'buyer') {
			throw new CHttpException(403, 'Only buyers can view their orders.');
		}

		$dataProvider = new CActiveDataProvider('Orders', [
			'criteria' => [
				'condition' => 'buyer_id = :uid',
				'params' => [':uid' => Yii::app()->user->id],
				'order' => 'created_at DESC',
				'with' => ['orderItems', 'seller'],
			],
			'pagination' => ['pageSize' => 10],
		]);

		$this->render('orders', ['dataProvider' => $dataProvider]);
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

		$this->render('checkout', [
			'totalAmount' => $totalAmount,
			'cartItems' => $cartItems,
		]);
	}

	public function actionSuccess($id)
	{
		$order = Orders::model()->findByPk($id);

		if (!$order || $order->buyer_id != Yii::app()->user->id) {
			throw new CHttpException(404, 'Order not found.');
		}

		$this->render('success', ['order' => $order]);
	}
}
