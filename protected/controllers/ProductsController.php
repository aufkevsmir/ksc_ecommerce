<?php

class ProductsController extends Controller
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
		array('allow',  // anyone can view and list products
			'actions'=>array('index','view'),
			'users'=>array('*'),
		),
		array('allow', // only authenticated sellers can create, update, delete
			'actions'=>array('create','update','delete'),
			'expression'=>'isset(Yii::app()->user->role) && Yii::app()->user->role === "seller"',
		),
		array('allow', // admin for admin page if needed
			'actions'=>array('admin'),
			'expression'=>'isset(Yii::app()->user->role) && Yii::app()->user->role === "admin"',
		),
		array('deny',  // deny everything else
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
		$model = Products::model()->with('company.user')->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'Product not found.');
		}

		$inquiries = Inquiries::model()->findAll([
			'condition' => 'product_id = :pid',
			'params' => [':pid' => $id],
			'order' => 't.created_at DESC',
			'limit' => 3,
			'with' => ['buyer'],
		]);

		$this->render('view', [
			'model' => $model,
			'inquiries' => $inquiries,
		]);
	}



	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'seller') {
			throw new CHttpException(403, 'Only sellers can create products.');
		}

		$company = Companies::model()->findByAttributes(['user_id' => Yii::app()->user->id]);
		if ($company === null) {
			Yii::app()->user->setFlash('error', 'Please create your company profile first.');
			$this->redirect(['companies/create']);
			return;
		}

		$model = new Products;

		if (isset($_POST['Products'])) {
			$model->attributes = $_POST['Products'];
			$model->company_id = $company->id;
			$model->created_at = new CDbExpression('NOW()');

			// Handle image file upload
			$imageFile = CUploadedFile::getInstanceByName('product_image');
			if ($imageFile !== null) {
				$filename = uniqid() . '_' . $imageFile->getName();
				$filepath = Yii::getPathOfAlias('webroot') . '/images/products/' . $filename;
				if ($imageFile->saveAs($filepath)) {
					$model->image_url = '/images/products/' . $filename;
				}
			}

			if ($model->save()) {
				Yii::app()->user->setFlash('success', 'Product created successfully.');
				$this->redirect(['seller/dashboard']);
			}
		}

		$this->render('create', ['model' => $model]);
	}




	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'seller') {
			throw new CHttpException(403, 'Unauthorized');
		}
	
		$model = Products::model()->findByPk($id);
	
		if (!$model || $model->company->user_id != Yii::app()->user->id) {
			throw new CHttpException(403, 'Access denied.');
		}
	
		if (isset($_POST['Products'])) {
			$model->attributes = $_POST['Products'];
	
			$imageFile = CUploadedFile::getInstanceByName('product_image');
			if ($imageFile !== null) {
				$filename = uniqid() . '_' . $imageFile->getName();
				$filepath = Yii::getPathOfAlias('webroot') . '/images/products/' . $filename;
				if ($imageFile->saveAs($filepath)) {
					$model->image_url = '/images/products/' . $filename;
				}
			}
	
			if ($model->save()) {
				Yii::app()->user->setFlash('success', 'Product updated.');
				$this->redirect(['products/index']);
			}
		}
	
		$this->render('update', ['model' => $model]);
	}
	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'seller') {
			throw new CHttpException(403, 'Unauthorized');
		}

		$model = Products::model()->findByPk($id);

		if (!$model || $model->company->user_id != Yii::app()->user->id) {
			throw new CHttpException(403, 'Access denied.');
		}

		$model->delete();
		Yii::app()->user->setFlash('success', 'Product deleted.');
		$this->redirect(['products/index']);
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

		if (!$company) {
			Yii::app()->user->setFlash('error', 'Please create your company profile first.');
			$this->redirect(['companies/create']);
			return;
		}

		$dataProvider = new CActiveDataProvider('Products', [
			'criteria' => [
				'condition' => 'company_id = :cid',
				'params' => [':cid' => $company->id],
				'order' => 'created_at DESC',
			],
			'pagination' => [
				'pageSize' => 5,
			],
		]);

		$this->render('index', ['dataProvider' => $dataProvider]);
	}



	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Products('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Products']))
			$model->attributes=$_GET['Products'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Products the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Products::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Products $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='products-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
