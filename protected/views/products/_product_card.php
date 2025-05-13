<div class="col-md-4 mb-4">
  <div class="card h-100">
    <?php if (!empty($data->image_blob)): ?>
      <img src="data:image/jpeg;base64,<?php echo base64_encode($data->image_blob); ?>" class="card-img-top" />
    <?php endif; ?>
    <div class="card-body">
      <h5 class="card-title"><?php echo CHtml::encode($data->name); ?></h5>
      <p class="card-text"><?php echo CHtml::encode($data->description); ?></p>
      <p><strong>₱<?php echo number_format($data->price, 2); ?></strong></p>
      <p class="text-muted mb-0">Stock: <?php echo $data->stock; ?></p>
      <p class="text-muted">Category: <?php echo CHtml::encode($data->category); ?></p>

      <div class="mt-3">
        <a href="<?php echo Yii::app()->createUrl('products/update', ['id' => $data->id]); ?>" class="btn btn-sm btn-primary">Edit</a>
        <?php echo CHtml::link('Delete', ['products/delete', 'id' => $data->id], array(
          'class' => 'btn btn-sm btn-danger',
          'confirm' => 'Are you sure you want to delete this product?',
          'submit' => ['products/delete', 'id' => $data->id],
        )); ?>
      </div>
    </div>
  </div>
</div>
