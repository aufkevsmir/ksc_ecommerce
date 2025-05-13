<div class="col-md-12 mb-3">
  <div class="card">
    <div class="card-body">
      <h5>Order #<?php echo $data->id; ?></h5>
      <p class="mb-1">Buyer: <?php echo CHtml::encode($data->buyer->full_name); ?></p>
      <p class="mb-1">Status: <span class="badge badge-info"><?php echo CHtml::encode($data->status); ?></span></p>
      <p class="mb-1">Total: ₱<?php echo number_format($data->total_amount, 2); ?></p>
      <p class="text-muted">Placed on: <?php echo date('Y-m-d', strtotime($data->created_at)); ?></p>
      <a href="<?php echo $this->createUrl('orders/updateStatus', ['id' => $data->id]); ?>" class="btn btn-sm btn-outline-primary mt-2">Update Status</a>
    </div>
  </div>
</div>
