<?php /** @var Orders $data */ ?>

<div class="border rounded p-3 mb-3 bg-light">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <div>
      <strong>Order #<?php echo $data->id; ?></strong><br>
      <small class="text-muted">Buyer: <?php echo CHtml::encode($data->buyer->full_name); ?></small>
    </div>
    <span class="badge badge-<?php
      switch ($data->status) {
        case 'pending': echo 'warning'; break;
        case 'paid': echo 'info'; break;
        case 'shipped': echo 'primary'; break;
        case 'completed': echo 'success'; break;
        case 'cancelled': echo 'secondary'; break;
      }
    ?>">
      <?php echo ucfirst($data->status); ?>
    </span>
  </div>

  <ul class="list-group mb-3">
    <?php foreach ($data->orderItems as $item): ?>
      <li class="list-group-item d-flex justify-content-between">
        <div><?php echo CHtml::encode($item->product->name); ?> × <?php echo $item->quantity; ?></div>
        <span>₱<?php echo number_format($item->price * $item->quantity, 2); ?></span>
      </li>
    <?php endforeach; ?>
  </ul>

  <div class="text-right">
    <strong>Total: ₱<?php echo number_format($data->total_amount, 2); ?></strong>
  </div>

  <?php if ($data->status === 'pending'): ?>
    <div class="text-right mt-2">
      <a href="<?php echo Yii::app()->createUrl('seller/approveOrder', ['id' => $data->id]); ?>" 
         class="btn btn-sm btn-success mr-2">Approve</a>
      <a href="<?php echo Yii::app()->createUrl('seller/declineOrder', ['id' => $data->id]); ?>" 
         class="btn btn-sm btn-danger"
         onclick="return confirm('Are you sure you want to decline this order?');">Decline</a>
    </div>
  <?php endif; ?>
</div>
