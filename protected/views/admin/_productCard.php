<?php /** @var Products $data */ ?>

<div class="col-md-4 mb-4">
  <div class="card h-100 shadow-sm">
    <img src="<?php echo !empty($data->image_url)
      ? Yii::app()->baseUrl . $data->image_url
      : Yii::app()->baseUrl . '/images/no-image.jpg'; ?>"
      class="card-img-top" style="height: 160px; object-fit: contain;" alt="Product image">

    <div class="card-body">
      <h5 class="card-title font-weight-bold mb-2"><?php echo CHtml::encode($data->name); ?></h5>
      <p class="mb-1">
        <small class="text-muted">Product ID:</small> <?php echo $data->id; ?><br>
        <small class="text-muted">Company:</small> <?php echo CHtml::encode($data->company->name); ?><br>
        <small class="text-muted">Category:</small> <?php echo CHtml::encode($data->category); ?><br>
        <small class="text-muted">Price:</small> ₱<?php echo number_format($data->price, 2); ?>
    </p>

    </div>
    <div class="card-footer bg-white text-right">
      <a href="<?php echo Yii::app()->createUrl('admin/editProduct', ['id' => $data->id]); ?>"
         class="btn btn-sm btn-outline-primary">
        Edit
      </a>
    </div>
  </div>
</div>
