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
            <?php if (!empty($recentOrders)): ?>
              <ul class="list-group">
                <?php foreach ($recentOrders as $order): ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Order #<?php echo $order->id; ?>
                    <span class="badge badge-pill badge-<?php echo $order->status === 'paid' ? 'success' : 'secondary'; ?>">
                      <?php echo ucfirst($order->status); ?>
                    </span>
                    <span class="text-muted small ml-2"><?php echo date('M d, Y', strtotime($order->created_at)); ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <p class="text-muted mb-0">You have no recent orders.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Cart Summary -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center">
          <div class="card-body">
            <h5 class="card-title">Your Cart</h5>
            <p class="card-text">Items waiting to checkout.</p>
            <a href="<?php echo $this->createUrl('cart/index'); ?>" class="btn btn-danger font-weight-bold">
              <i class="bi bi-cart-fill"></i> Go to Cart
            </a>
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
        <?php if (!empty($recentInquiries)): ?>
          <ul class="list-group">
            <?php foreach ($recentInquiries as $inquiry): ?>
              <li class="list-group-item d-flex justify-content-between">
                <?php echo CHtml::encode($inquiry->product->name); ?>
                <span class="text-muted small"><?php echo date('M d, Y', strtotime($inquiry->created_at)); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p class="text-muted mb-0">You haven't made any inquiries yet.</p>
        <?php endif; ?>
      </div>
    </div>

  </div>
</div>
