<?php
$this->pageTitle = 'Edit Product';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
  <div class="section-card compact-card">

    <h2 class="mb-4 text-danger">Edit Product</h2>

    <?php echo CHtml::beginForm('', 'post', ['enctype' => 'multipart/form-data']); ?>

    <div class="form-group">
      <label>Product Name</label>
      <?php echo CHtml::activeTextField($model, 'name', ['class' => 'form-control']); ?>
    </div>

    <div class="form-group">
      <label>Category</label>
      <?php echo CHtml::activeTextField($model, 'category', ['class' => 'form-control']); ?>
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
      <label>Description</label>
      <?php echo CHtml::activeTextArea($model, 'description', ['class' => 'form-control', 'rows' => 4]); ?>
    </div>

    <div class="form-group">
      <label>Product Image (optional)</label>
      <?php echo CHtml::fileField('product_image', '', ['class' => 'form-control-file']); ?>
    </div>

    <div class="d-flex justify-content-between mt-4">
      <a href="<?php echo $this->createUrl('admin/products'); ?>" class="btn btn-secondary">Cancel</a>
      <?php echo CHtml::submitButton('Save Changes', ['class' => 'btn btn-danger']); ?>
    </div>

    <?php echo CHtml::endForm(); ?>
  </div>
</div>
