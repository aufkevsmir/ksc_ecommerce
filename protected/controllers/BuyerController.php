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

    if ($_POST) {
        require_once(dirname(__FILE__) . '/../../vendor/autoload.php');
        \Stripe\Stripe::setApiKey(Yii::app()->params['stripeSecretKey']);

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
            $order->seller_id = $cartItems[0]->product->company_id; // Assume single seller
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

                // ✅ Zapier webhook
                $buyer = Users::model()->findByPk($userId);
                $webhookUrl = 'https://hooks.zapier.com/hooks/catch/22896966/2nxpkub/';

                $payload = [
                    'order_id' => $order->id,
                    'buyer_email' => $buyer->email,
                    'total_amount' => $totalAmount,
                    'payment_reference' => $charge->id,
                    'paid_at' => date('Y-m-d H:i:s'),
                ];

                $ch = curl_init($webhookUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                curl_setopt($ch, CURLOPT_POST, true);
                curl_exec($ch);
                curl_close($ch);

                $this->redirect(['buyer/success', 'id' => $order->id]);
            } else {
                Yii::app()->user->setFlash('error', 'Order saving failed.');
                $this->redirect(['cart/index']);
            }

        } catch (\Stripe\Exception\CardException $e) {
            Yii::app()->user->setFlash('error', 'Payment failed: ' . $e->getMessage());
            $this->redirect(['cart/index']);
        }
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
