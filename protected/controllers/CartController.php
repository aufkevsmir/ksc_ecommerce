
<?php

class CartController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
{
    return array(
        array('allow',
            'actions' => array('index', 'add', 'remove', 'checkout'),
            'users' => array('@'),
            'expression' => 'Yii::app()->user->role === "buyer"',
        ),
        array('deny',
            'users' => array('*'),
        ),
    );
}



	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Cart;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cart']))
		{
			$model->attributes=$_POST['Cart'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cart']))
		{
			$model->attributes=$_POST['Cart'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$userId = Yii::app()->user->id;
		$cartItems = Cart::model()->with('product')->findAllByAttributes(['user_id' => $userId]);

		if (isset($_POST['Cart'])) {
			foreach ($_POST['Cart'] as $id => $data) {
				$cartItem = Cart::model()->findByPk($id);
				if ($cartItem && $cartItem->user_id == $userId) {
					$quantity = (int)$data['quantity'];
					$cartItem->quantity = max(1, $quantity); // prevent zero or negative
					$cartItem->save();
				}
			}
			Yii::app()->user->setFlash('success', 'Cart updated.');
			$this->redirect(['cart/index']);
		}

		$this->render('index', ['cartItems' => $cartItems]);
	}



	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cart('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cart']))
			$model->attributes=$_GET['Cart'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cart the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cart::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cart $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cart-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAdd($id)
    {
        $product = Products::model()->findByPk($id);

        if ($product === null) {
            throw new CHttpException(404, 'Product not found.');
        }

        $cart = Cart::model()->findByAttributes([
            'user_id' => Yii::app()->user->id,
            'product_id' => $id,
        ]);

        if ($cart) {
            $cart->quantity += 1;
        } else {
            $cart = new Cart;
            $cart->user_id = Yii::app()->user->id;
            $cart->product_id = $id;
            $cart->quantity = 1;
        }

        if ($cart->save()) {
            Yii::app()->user->setFlash('success', 'Product added to cart.');
        } else {
            Yii::app()->user->setFlash('error', 'Failed to add product to cart.');
        }

        $this->redirect(['cart/index']);
    }

	public function actionRemove($id)
	{
		$item = Cart::model()->findByPk($id);
		if ($item && $item->user_id == Yii::app()->user->id) {
			$item->delete();
			Yii::app()->user->setFlash('success', 'Item removed from cart.');
		}
		$this->redirect(['cart/index']);
	}

	public function actionCheckout()
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'buyer') {
			throw new CHttpException(403, 'Only buyers can place orders.');
		}

		$cartItems = Cart::model()->findAllByAttributes([
			'user_id' => Yii::app()->user->id,
		]);

		if (empty($cartItems)) {
			Yii::app()->user->setFlash('error', 'Your cart is empty.');
			$this->redirect(['cart/index']);
		}

		// Group cart items by seller (company_id)
		$sellerGroups = [];
		foreach ($cartItems as $item) {
			$sellerId = $item->product->company_id;
			if (!isset($sellerGroups[$sellerId])) {
				$sellerGroups[$sellerId] = [];
			}
			$sellerGroups[$sellerId][] = $item;
		}

		foreach ($sellerGroups as $companyId => $items) {
			$order = new Orders;
			$order->buyer_id = Yii::app()->user->id;
			$order->seller_id = $companyId;
			$order->status = 'pending';
			$order->created_at = new CDbExpression('NOW()');
			$order->total_amount = 0;

			if ($order->save()) {
				foreach ($items as $cartItem) {
					$product = $cartItem->product;
					$item = new OrderItems;
					$item->order_id = $order->id;
					$item->product_id = $product->id;
					$item->quantity = $cartItem->quantity;
					$item->price = $product->price;
					$order->total_amount += $product->price * $cartItem->quantity;
					$item->save();
				}
				$order->save(); // save final total_amount
			}
		}

		// Clear cart
		Cart::model()->deleteAllByAttributes(['user_id' => Yii::app()->user->id]);

		Yii::app()->user->setFlash('success', 'Your order has been placed.');
		$this->redirect(['buyer/orders']);
	}


}
