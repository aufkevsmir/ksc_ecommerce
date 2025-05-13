<?php
$this->pageTitle = 'Edit Product';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/products/create.css" rel="stylesheet">

<div class="container mt-4">
  <h2 class="mb-4 text-orange">Edit Product</h2>

  <?php echo CHtml::beginForm('', 'post', array('enctype' => 'multipart/form-data')); ?>

  <div class="form-group">
    <label>Product Name</label>
    <?php echo CHtml::activeTextField($model, 'name', ['class' => 'form-control']); ?>
  </div>

  <div class="form-group">
    <label>Description</label>
    <?php echo CHtml::activeTextArea($model, 'description', ['class' => 'form-control', 'rows' => 4]); ?>
  </div>

  <div class="form-group">
    <label>Price</label>
    <?php echo CHtml::activeTextField($model, 'price', ['class' => 'form-control']); ?>
  </div>

  <div class="form-group">
    <label>Stock</label>
    <?php echo CHtml::activeTextField($model, 'stock', ['class' => 'form-control']); ?>
  </div>

  <div class="form-group">
    <label>Category</label>
    <?php echo CHtml::activeDropDownList($model, 'category', [
      'Electronics' => 'Electronics',
      'Fashion' => 'Fashion',
      'Home' => 'Home',
      'Other' => 'Other'
    ], ['class' => 'form-control']); ?>
  </div>

  <div class="form-group">
    <label>Upload New Image (optional)</label>
    <?php echo CHtml::fileField('product_image', '', ['class' => 'form-control-file']); ?>
  </div>

  <?php echo CHtml::submitButton('Save Changes', ['class' => 'btn btn-orange']); ?>
  <?php echo CHtml::endForm(); ?>
</div>
