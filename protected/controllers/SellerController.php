<?php
class SellerController extends Controller
{

    public function actionDashboard()
{
	if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'seller') {
		throw new CHttpException(403, 'Unauthorized.');
	}

	$company = Companies::model()->findByAttributes(['user_id' => Yii::app()->user->id]);
	if (!$company) {
		throw new CHttpException(404, 'Company not found.');
	}

	// Summary counts
	$productCount = Products::model()->countByAttributes(['company_id' => $company->id]);
	$orderCount = Orders::model()->count('seller_id = :sid', [':sid' => $company->id]);
	$inquiryCount = Inquiries::model()->count([
		'condition' => 'product_id IN (SELECT id FROM products WHERE company_id = :cid) AND status = "new"',
		'params' => [':cid' => $company->id],
	]);

	// Recent 5 products
	$products = Products::model()->findAllByAttributes(['company_id' => $company->id], [
		'order' => 'created_at DESC',
		'limit' => 5,
	]);

	// Recent 5 orders
	$recentOrders = Orders::model()->findAll([
		'condition' => 'seller_id = :sid',
		'params' => [':sid' => $company->id],
		'order' => 't.created_at DESC',
		'limit' => 5,
		'with' => ['buyer'],
	]);

	// Recent 5 inquiries
	$recentInquiries = Inquiries::model()->with('product', 'buyer')->findAll([
		'condition' => 'product.company_id = :cid',
		'params' => [':cid' => $company->id],
		'order' => 't.created_at DESC',
		'limit' => 5,
		'together' => true,
	]);

	$this->render('dashboard', [
		'company' => $company,
		'productCount' => $productCount,
		'orderCount' => $orderCount,
		'inquiryCount' => $inquiryCount,
		'products' => $products,
		'recentOrders' => $recentOrders,
		'recentInquiries' => $recentInquiries,
	]);
}



    public function actionOrders()
    {
        if (Yii::app()->user->isGuest || Yii::app()->user->role !== 'seller') {
            throw new CHttpException(403, 'Unauthorized.');
        }

        $company = Companies::model()->findByAttributes(['user_id' => Yii::app()->user->id]);
        if (!$company) {
            throw new CHttpException(404, 'Company not found.');
        }

        $criteria = new CDbCriteria([
            'condition' => 'seller_id = :cid',
            'params' => [':cid' => $company->id],
            'order' => 't.created_at DESC',
            'with' => ['buyer', 'orderItems.product'],
        ]);

        $dataProvider = new CActiveDataProvider('Orders', [
            'criteria' => $criteria,
            'pagination' => ['pageSize' => 5],
        ]);

        $this->render('orders', ['dataProvider' => $dataProvider]);
    }


    public function actionApproveOrder($id)
    {
        $order = Orders::model()->findByPk($id);
        if (!$order || $order->seller_id != $this->getCompanyId()) {
            throw new CHttpException(403, 'Unauthorized');
        }

        $order->status = 'paid'; // or your desired status
        if ($order->save()) {
            Yii::app()->user->setFlash('success', 'Order approved.');
        }
        $this->redirect(['seller/orders']);
    }

public function actionDeclineOrder($id)
    {
        $order = Orders::model()->findByPk($id);
        if (!$order || $order->seller_id != $this->getCompanyId()) {
            throw new CHttpException(403, 'Unauthorized');
        }

        $order->status = 'cancelled';
        if ($order->save()) {
            Yii::app()->user->setFlash('success', 'Order declined.');
        }
        $this->redirect(['seller/orders']);
    }

    private function getCompanyId()
    {
        $company = Companies::model()->findByAttributes(['user_id' => Yii::app()->user->id]);
        return $company ? $company->id : null;
    }

}
