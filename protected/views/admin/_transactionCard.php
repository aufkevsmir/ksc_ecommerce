<?php /** @var Transactions $data */ ?>

<div class="card shadow-sm mb-4">
  <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
    <div>
      <strong>Transaction #<?php echo $data->id; ?></strong><br>
      <small class="text-muted">
        Buyer: <?php echo CHtml::encode($data->order->buyer->full_name); ?><br>
        Order ID: <?php echo $data->order->id; ?>
      </small>
    </div>
    <small class="text-muted"><?php echo date('M j, Y g:i A', strtotime($data->created_at)); ?></small>
  </div>

  <div class="card-body d-flex justify-content-between align-items-center">
    <div>
      <div><strong>Status:</strong>
        <span class="badge badge-<?php echo $data->status === 'completed' ? 'success' : 'warning'; ?>">
          <?php echo ucfirst($data->status); ?>
        </span>
      </div>
    </div>
    <div class="text-right">
      <div class="font-weight-bold">Total:</div>
      <div class="text-danger font-weight-bold">₱<?php echo number_format($data->amount, 2); ?></div>
    </div>
  </div>
</div>
