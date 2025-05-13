<?php

class InquiriesController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to perform 'create', 'update', and 'reply'
				'actions'=>array('create','update','reply', 'my'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
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
	public function actionCreate($product_id)
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'buyer') {
			throw new CHttpException(403, 'Only buyers can send inquiries.');
		}

		$product = Products::model()->findByPk($product_id);
		if (!$product) {
			throw new CHttpException(404, 'Product not found.');
		}

		$model = new Inquiries;
		$model->product_id = $product->id;

		if (isset($_POST['Inquiries'])) {
			$model->attributes = $_POST['Inquiries'];
			$model->buyer_id = Yii::app()->user->id;
			$model->created_at = new CDbExpression('NOW()');

			if ($model->save()) {
				Yii::app()->user->setFlash('success', 'Your inquiry was sent.');
				$this->redirect(['products/view', 'id' => $product_id]);
			}
		}

		$this->render('create', ['model' => $model, 'product' => $product]);
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

		if(isset($_POST['Inquiries']))
		{
			$model->attributes=$_POST['Inquiries'];
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
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'seller') {
			throw new CHttpException(403, 'Unauthorized');
		}

		$company = Companies::model()->findByAttributes(['user_id' => Yii::app()->user->id]);

		$dataProvider = new CActiveDataProvider('Inquiries', [
			'criteria' => [
				'with' => ['product'],
				'condition' => 'product.company_id = :cid',
				'params' => [':cid' => $company->id],
				'together' => true,
				'order' => 't.created_at DESC',
			],
			'pagination' => ['pageSize' => 10],
		]);

		$this->render('index', ['dataProvider' => $dataProvider]);
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Inquiries('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Inquiries']))
			$model->attributes=$_GET['Inquiries'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Inquiries the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Inquiries::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Inquiries $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='inquiries-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionReply($id)
{
	if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'seller') {
		throw new CHttpException(403, 'Unauthorized');
	}

	$model = $this->loadModel($id);

	if (!$model || $model->product->company->user_id != Yii::app()->user->id) {
		throw new CHttpException(403, 'Access denied.');
	}

	if (isset($_POST['Inquiries'])) {
		$model->reply_message = $_POST['Inquiries']['reply_message'];
		$model->status = 'responded';
		if ($model->save()) {
			Yii::app()->user->setFlash('success', 'Reply sent.');
			$this->redirect(['inquiries/index']);
		}
	}

	$this->render('reply', ['model' => $model]);
}

public function actionMy()
{
	if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'buyer') {
		throw new CHttpException(403, 'Unauthorized');
	}

	$dataProvider = new CActiveDataProvider('Inquiries', [
		'criteria' => [
			'condition' => 'buyer_id = :uid',
			'params' => [':uid' => Yii::app()->user->id],
			'order' => 't.created_at DESC',
			'with' => ['product'],
		],
		'pagination' => ['pageSize' => 10],
	]);

	$this->render('my', ['dataProvider' => $dataProvider]);
}


}
