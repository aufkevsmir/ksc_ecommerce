<?php /** @var Orders $data */ ?>

<div class="card shadow-sm mb-4">
  <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
    <div>
      <strong>Order #<?php echo $data->id; ?></strong><br>
      <small class="text-muted">
        📅 <?php echo date('M j, Y g:i A', strtotime($data->created_at)); ?>
      </small><br>
      <small class="text-muted">
        Seller: <?php echo CHtml::encode($data->seller->name); ?>
      </small><br>
      <small class="text-muted">
        📦 Delivery: Standard Delivery
      </small>
    </div>
    <span class="badge badge-pill badge-<?php
      switch ($data->status) {
        case 'paid': echo 'success'; break;
        case 'shipped': echo 'info'; break;
        case 'completed': echo 'primary'; break;
        case 'cancelled': echo 'secondary'; break;
        default: echo 'warning'; // pending
      }
    ?>">
      <?php echo ucfirst($data->status); ?>
    </span>
  </div>

  <div class="card-body p-0">
    <?php foreach ($data->orderItems as $item): ?>
      <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
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

    <div class="d-flex justify-content-between align-items-center px-3 py-3">
      <a href="<?php echo Yii::app()->createUrl('orders/view', ['id' => $data->id]); ?>"
         class="btn btn-sm btn-outline-primary">
        View Details
      </a>
      <div class="text-right">
        <div class="mb-2 font-weight-bold">
          Total: <span class="text-danger">₱<?php echo number_format($data->total_amount, 2); ?></span>
        </div>

        <?php if ($data->status === 'pending'): ?>
          <a href="<?php echo Yii::app()->createUrl('orders/cancel', ['id' => $data->id]); ?>"
             class="btn btn-sm btn-outline-danger"
             onclick="return confirm('Are you sure you want to cancel this order?');">
            Cancel Order
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
