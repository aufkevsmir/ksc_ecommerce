<?php
$this->pageTitle = 'Order Successful';
?>

<div class="container mt-5">
    <div class="alert alert-success text-center">
        <h3 class="mb-3">🎉 Thank you for your purchase!</h3>
        <p>Your order has been placed successfully and your payment was confirmed via Stripe.</p>
        <p>You can view your order history from your <a href="<?php echo $this->createUrl('orders/index'); ?>">My Orders</a> page.</p>
    </div>
</div>
