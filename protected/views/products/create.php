<?php
$this->pageTitle = 'Upload Product';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/products/create.css" rel="stylesheet">

<div class="container mt-4">
  <div class="section-card compact-card">

    <h2 class="mb-4 text-danger">Upload New Product</h2>

    <?php echo CHtml::beginForm('', 'post', ['enctype' => 'multipart/form-data']); ?>

    <div class="form-group">
      <?php echo CHtml::label('Product Name', 'Products_name'); ?>
      <?php echo CHtml::activeTextField($model, 'name', ['class' => 'form-control']); ?>
    </div>

    <div class="form-group">
      <?php echo CHtml::label('Description', 'Products_description'); ?>
      <?php echo CHtml::activeTextArea($model, 'description', ['class' => 'form-control', 'rows' => 4]); ?>
    </div>

    <div class="form-group">
      <?php echo CHtml::label('Price', 'Products_price'); ?>
      <?php echo CHtml::activeTextField($model, 'price', ['class' => 'form-control']); ?>
    </div>

    <div class="form-group">
      <?php echo CHtml::label('Stock', 'Products_stock'); ?>
      <?php echo CHtml::activeTextField($model, 'stock', ['class' => 'form-control']); ?>
    </div>

    <div class="form-group">
      <?php echo CHtml::label('Category', 'Products_category'); ?>
      <?php echo CHtml::activeDropDownList($model, 'category', [
        'Men\'s Apparel' => 'Men\'s Apparel',
        'Mobiles & Gadgets' => 'Mobiles & Gadgets',
        'Home & Living' => 'Home & Living',
        'Electronics' => 'Electronics',
        'Office Supplies' => 'Office Supplies',
        'Industrial Tools' => 'Industrial Tools',
        'Beauty & Health' => 'Beauty & Health',
        'Food & Beverage' => 'Food & Beverage',
      ], ['class' => 'form-control']); ?>
    </div>


    <div class="form-group">
      <?php echo CHtml::label('Upload Image', 'product_image'); ?>
      <?php echo CHtml::fileField('product_image', '', ['class' => 'form-control-file']); ?>
    </div>

    <?php echo CHtml::submitButton('Create Product', ['class' => 'btn btn-danger']); ?>

    <?php echo CHtml::endForm(); ?>
  </div>
</div>
