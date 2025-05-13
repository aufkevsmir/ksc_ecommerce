<?php
$this->pageTitle = 'Buyer Dashboard';
?>
<link href="<?php echo Yii::app()->baseUrl; ?>/css/site/index.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/buyer/dashboard.css" rel="stylesheet">

<div class="container mt-4">
  <div class="section-card compact-card buyer-dashboard">

    <h2 class="mb-4 text-danger">Welcome, <?php echo CHtml::encode(Yii::app()->user->name); ?>!</h2>

    <div class="row">
      <!-- Orders -->
      <div class="col-md-8 mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-orange text-white">
            Recent Orders
          </div>
          <div class="card-body">
            <p class="text-muted">You have no recent orders.</p>
            <!-- Future: dynamic order table -->
          </div>
        </div>
      </div>

      <!-- Cart Summary -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center">
          <div class="card-body">
            <h5 class="card-title">Your Cart</h5>
            <p class="card-text">Items waiting to checkout.</p>
            <a href="<?php echo $this->createUrl('cart/index'); ?>" class="btn btn-orange">Go to Cart</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Inquiries -->
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-orange text-white">
        Your Inquiries
      </div>
      <div class="card-body">
        <p class="text-muted">You haven't made any inquiries yet.</p>
        <!-- Future: dynamic inquiry list -->
      </div>
    </div>

  </div>
</div>
