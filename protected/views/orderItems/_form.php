<?php
/* @var $this OrderItemsController */
/* @var $model OrderItems */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-items-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'order_id'); ?>
		<?php echo $form->textField($model,'order_id'); ?>
		<?php echo $form->error($model,'order_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->