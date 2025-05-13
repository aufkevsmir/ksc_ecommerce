<?php
/* @var $this CompaniesController */
/* @var $model Companies */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', ['id' => 'company-form', 'htmlOptions' => ['class' => '']]); ?>

  <?php echo $form->errorSummary($model, null, null, ['class' => 'alert alert-danger']); ?>

  <div class="form-group">
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', ['class' => 'form-control']); ?>
    <?php echo $form->error($model, 'name', ['class' => 'text-danger']); ?>
  </div>

  <div class="form-group">
    <?php echo $form->labelEx($model, 'address'); ?>
    <?php echo $form->textArea($model, 'address', ['class' => 'form-control']); ?>
    <?php echo $form->error($model, 'address', ['class' => 'text-danger']); ?>
  </div>

  <div class="form-group">
    <?php echo $form->labelEx($model, 'contact_number'); ?>
    <?php echo $form->textField($model, 'contact_number', ['class' => 'form-control']); ?>
    <?php echo $form->error($model, 'contact_number', ['class' => 'text-danger']); ?>
  </div>

  <div class="form-group">
    <?php echo $form->labelEx($model, 'industry'); ?>
    <?php echo $form->textField($model, 'industry', ['class' => 'form-control']); ?>
    <?php echo $form->error($model, 'industry', ['class' => 'text-danger']); ?>
  </div>

  <div class="form-group">
    <?php echo CHtml::submitButton('Save', ['class'=>'btn btn-orange']); ?>
  </div>

<?php $this->endWidget(); ?>
