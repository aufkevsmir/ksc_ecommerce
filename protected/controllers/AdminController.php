<?php
class AdminController extends Controller
{
	// --- DASHBOARD ---
	public function actionIndex()
	{
		$this->requireAdmin();
		$this->render('index');
	}

	// --- USERS ---
	public function actionUsers()
	{
		$this->requireAdmin();
		$dataProvider = new CActiveDataProvider('Users', [
			'criteria' => ['order' => 'created_at DESC'],
			'pagination' => ['pageSize' => 6],
		]);
		$this->render('users', ['dataProvider' => $dataProvider]);
	}

	public function actionEditUser($id)
	{
		$this->requireAdmin();
		$model = Users::model()->findByPk($id);
		if (!$model) throw new CHttpException(404, 'User not found.');

		if (isset($_POST['Users'])) {
			$model->attributes = $_POST['Users'];
			if ($model->save()) {
				$this->redirect(['admin/users']);
			}
		}
		$this->render('editUser', ['model' => $model]);
	}

	// --- COMPANIES ---
    public function actionCompanies()
    {
        $this->requireAdmin();
        $dataProvider = new CActiveDataProvider('Companies', [
            'criteria' => [
                'order' => 'id DESC' // ✅ using existing column
            ],
            'pagination' => ['pageSize' => 6],
        ]);
        $this->render('companies', ['dataProvider' => $dataProvider]);
    }

	public function actionEditCompany($id)
	{
		$this->requireAdmin();
		$model = Companies::model()->findByPk($id);
		if (!$model) throw new CHttpException(404, 'Company not found.');

		if (isset($_POST['Companies'])) {
			$model->attributes = $_POST['Companies'];
			if ($model->save()) {
				$this->redirect(['admin/companies']);
			}
		}
		$this->render('editCompany', ['model' => $model]);
	}

	// --- PRODUCTS ---
	public function actionProducts()
	{
		$this->requireAdmin();
		$dataProvider = new CActiveDataProvider('Products', [
			'criteria' => [
				'with' => ['company'],
				'order' => 't.created_at DESC',
			],
			'pagination' => ['pageSize' => 6],
		]);
		$this->render('products', ['dataProvider' => $dataProvider]);
	}

	public function actionEditProduct($id)
	{
		$this->requireAdmin();
		$model = Products::model()->findByPk($id);
		if (!$model) throw new CHttpException(404, 'Product not found.');

		if (isset($_POST['Products'])) {
			$model->attributes = $_POST['Products'];
			if ($model->save()) {
				$this->redirect(['admin/products']);
			}
		}
		$this->render('editProduct', ['model' => $model]);
	}

	// --- ORDERS ---
	public function actionOrders()
	{
		$this->requireAdmin();
		$dataProvider = new CActiveDataProvider('Orders', [
			'criteria' => [
				'with' => ['buyer', 'seller', 'orderItems.product'],
				'order' => 't.created_at DESC',
			],
			'pagination' => ['pageSize' => 5],
		]);
		$this->render('orders', ['dataProvider' => $dataProvider]);
	}

	// --- INQUIRIES ---
	public function actionInquiries()
	{
		$this->requireAdmin();
		$dataProvider = new CActiveDataProvider('Inquiries', [
			'criteria' => [
				'with' => ['product', 'buyer'],
				'order' => 't.created_at DESC',
			],
			'pagination' => ['pageSize' => 6],
		]);
		$this->render('inquiries', ['dataProvider' => $dataProvider]);
	}

	// --- TRANSACTIONS ---
	public function actionTransactions()
    {
        $this->requireAdmin();

        $criteria = new CDbCriteria([
            'with' => ['order.buyer'],
            'order' => 't.paid_at DESC',
            'limit' => 6,
        ]);

        $dataProvider = new CActiveDataProvider('Transactions', [
            'criteria' => $criteria,
            'pagination' => ['pageSize' => 10],
        ]);

        $this->render('transactions', ['dataProvider' => $dataProvider]);
    }


	// --- GUARD ---
	private function requireAdmin()
	{
		if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'admin') {
			throw new CHttpException(403, 'Unauthorized access.');
		}
	}
}


