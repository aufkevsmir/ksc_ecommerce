<?php
$this->pageTitle = 'Send Inquiry';
?>

<div class="container mt-4">
  <h2 class="mb-3 text-orange">Inquiry for: <?php echo CHtml::encode($product->name); ?></h2>

  <?php echo CHtml::beginForm(); ?>

  <div class="form-group">
    <label>Your Message</label>
    <?php echo CHtml::activeTextArea($model, 'message', ['class' => 'form-control', 'rows' => 4]); ?>
  </div>

  <?php echo CHtml::submitButton('Send Inquiry', ['class' => 'btn btn-orange']); ?>
  <?php echo CHtml::endForm(); ?>
</div>
