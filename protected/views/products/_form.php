<?php
/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>

<div class="form">


<?php $form = $this->beginWidget('CActiveForm', ['id'=>'product-form']); ?>

  <p class="note">Fields with <span class="required">*</span> are required.</p>

  <?php echo $form->errorSummary($model); ?>

  <div class="mb-4">
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', ['class'=>'border p-2 w-full rounded']); ?>
    <?php echo $form->error($model, 'name'); ?>
  </div>

  <div class="mb-4">
    <?php echo $form->labelEx($model, 'description'); ?>
    <?php echo $form->textArea($model, 'description', ['class'=>'border p-2 w-full rounded']); ?>
    <?php echo $form->error($model, 'description'); ?>
  </div>

  <div class="mb-4">
    <?php echo $form->labelEx($model, 'price'); ?>
    <?php echo $form->textField($model, 'price', ['class'=>'border p-2 w-full rounded']); ?>
    <?php echo $form->error($model, 'price'); ?>
  </div>

  <div class="mb-4">
    <?php echo $form->labelEx($model, 'stock'); ?>
    <?php echo $form->textField($model, 'stock', ['class'=>'border p-2 w-full rounded']); ?>
    <?php echo $form->error($model, 'stock'); ?>
  </div>

  <div class="mb-4">
    <?php echo $form->labelEx($model, 'image_url'); ?>
    <?php echo $form->textField($model, 'image_url', ['class'=>'border p-2 w-full rounded']); ?>
    <?php echo $form->error($model, 'image_url'); ?>
  </div>

  <div>
    <?php echo CHtml::submitButton('Upload', ['class'=>'bg-blue-500 text-white px-4 py-2 rounded']); ?>
  </div>

<?php $this->endWidget(); ?>


</div><!-- form -->