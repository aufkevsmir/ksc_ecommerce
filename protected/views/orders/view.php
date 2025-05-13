<?php
$this->pageTitle = 'Order Details';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4 mb-5">
  <h4 class="mb-4 font-weight-bold text-danger">Order #<?php echo $order->id; ?></h4>

  <div class="card shadow-sm mb-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
      <div>
        <div class="mb-1">
          <strong>Status:</strong>
          <span class="badge badge-<?php echo $order->status === 'paid' ? 'success' : 'secondary'; ?>">
            <?php echo ucfirst($order->status); ?>
          </span>
        </div>
        <small class="text-muted">
          📅 Ordered on <?php echo date('F j, Y g:i A', strtotime($order->created_at)); ?>
        </small><br>
        <small class="text-muted">
          🏬 Seller: <?php echo CHtml::encode($order->seller->name); ?>
        </small><br>
        <small class="text-muted">
          📦 Delivery: Standard Delivery
        </small>
      </div>
    </div>

    <div class="card-body p-0">
      <?php foreach ($order->orderItems as $item): ?>
        <div class="d-flex justify-content-between align-items-center px-3 py-3 border-bottom">
          <div class="d-flex align-items-center">
            <img src="<?php echo !empty($item->product->image_url)
              ? Yii::app()->baseUrl . $item->product->image_url
              : Yii::app()->baseUrl . '/images/no-image.jpg'; ?>"
              class="rounded mr-3" style="width: 60px; height: 60px; object-fit: contain;">
            <div>
              <div><?php echo CHtml::encode($item->product->name); ?></div>
              <small class="text-muted">Qty: <?php echo $item->quantity; ?></small>
            </div>
          </div>
          <div class="text-danger font-weight-bold">
            ₱<?php echo number_format($item->price * $item->quantity, 2); ?>
          </div>
        </div>
      <?php endforeach; ?>

      <!-- Summary -->
      <div class="px-3 py-3">
        <div class="d-flex justify-content-between">
          <span class="text-muted">Payment Method:</span>
          <span><?php echo ucfirst($order->transaction->payment_method); ?></span>
        </div>
        <div class="d-flex justify-content-between font-weight-bold mt-2">
          <span>Total:</span>
          <span class="text-danger">₱<?php echo number_format($order->total_amount, 2); ?></span>
        </div>
      </div>
    </div>
  </div>

  <a href="<?php echo $this->createUrl('orders/index'); ?>" class="btn btn-outline-secondary">
    ← Back to My Orders
  </a>
</div>
