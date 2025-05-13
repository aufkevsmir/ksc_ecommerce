<div class="list-group-item">
  <h5>Product: <?php echo CHtml::encode($data->product->name); ?></h5>
  <p class="mb-1"><strong>Buyer:</strong> <?php echo CHtml::encode($data->buyer->full_name); ?></p>
  <p class="mb-1"><strong>Message:</strong> <?php echo CHtml::encode($data->message); ?></p>
  <p class="text-muted"><?php echo date('Y-m-d H:i', strtotime($data->created_at)); ?></p>
</div>
