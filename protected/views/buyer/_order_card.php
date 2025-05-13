<div class="list-group-item">
  <h5>Order #<?php echo $data->id; ?> | Seller: <?php echo CHtml::encode($data->seller->name); ?></h5>
  <p class="mb-1">Status: <span class="badge badge-info"><?php echo CHtml::encode($data->status); ?></span></p>
  <p class="mb-1">Total: ₱<?php echo number_format($data->total_amount, 2); ?></p>
  <p class="mb-2 text-muted">Placed on: <?php echo date('Y-m-d H:i', strtotime($data->created_at)); ?></p>

  <ul>
    <?php foreach ($data->orderItems as $item): ?>
      <li><?php echo CHtml::encode($item->product->name); ?> × <?php echo $item->quantity; ?></li>
    <?php endforeach; ?>
  </ul>
</div>
