<?php

class SiteController extends Controller
{
	public $layout = '//layouts/main';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
		public function actionIndex()
	{
		$criteria = new CDbCriteria([
			'order' => 'created_at DESC',
		]);

		// Filter by category if passed in GET
		if (!empty($_GET['category'])) {
			$criteria->addCondition('category = :cat');
			$criteria->params[':cat'] = $_GET['category'];
		}

		$dataProvider = new CActiveDataProvider('Products', [
			'criteria' => $criteria,
			'pagination' => [
				'pageSize' => 8,
			],
		]);

		$categories = [
			'Men\'s Apparel' => 'mens.png',
			'Mobiles & Gadgets' => 'mobiles.png',
			'Home & Living' => 'home.png',
			'Electronics' => 'electronics.png',
			'Office Supplies' => 'office.png',
			'Industrial Tools' => 'tools.png',
			'Beauty & Health' => 'beauty.png',
			'Food & Beverage' => 'food.png',
		];

		$this->render('index', [
			'dataProvider' => $dataProvider,
			'categories' => $categories,
			'selectedCategory' => isset($_GET['category']) ? $_GET['category'] : null,
		]);
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new LoginForm;

		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			if ($model->validate() && $model->login()) {
				// FIX: Use Users model instead of User
				$user = Users::model()->findByAttributes(['email' => $model->email]);
				if ($user !== null) {
					Yii::app()->user->setState('role', $user->role);
				}
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$registerModel = new Users; // FIX: Use Users model for registration form
		$this->render('login', array(
			'model' => $model,
			'registerModel' => $registerModel,
		));
	}




	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}


	public function actionRegister()
	{
		$model = new Users;

		if (isset($_POST['Users'])) {
			$model->attributes = $_POST['Users'];

			// Hash the password
			$model->password_hash = CPasswordHelper::hashPassword($model->password_hash);
			$model->created_at = new CDbExpression('NOW()');

			if ($model->save()) {
				Yii::app()->user->setFlash('success', 'Registration successful. You can now login.');
				$this->redirect(array('site/login'));
			}
		}

		// Reuse login form for fallback rendering
		$loginModel = new LoginForm;

		$this->render('login', array(
			'registerModel' => $model,
			'model' => $loginModel,
		));
	}




	public function actionSellerDashboard()
	{
		$company = Companies::model()->findByAttributes(['user_id' => Yii::app()->user->id]);
		$this->render('sellerDashboard', ['company' => $company]);
	}


}