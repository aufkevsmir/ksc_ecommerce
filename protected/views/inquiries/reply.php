<?php
$this->pageTitle = 'Reply to Inquiry';
?>

<div class="container mt-4">
  <h2 class="mb-3">Reply to Inquiry</h2>

  <div class="card mb-3">
    <div class="card-header bg-light">
      <strong>Product:</strong> <?php echo CHtml::encode($model->product->name); ?>
    </div>
    <div class="card-body">
      <p><strong>Buyer:</strong> <?php echo CHtml::encode($model->buyer->full_name); ?></p>
      <p><strong>Message:</strong><br><?php echo nl2br(CHtml::encode($model->message)); ?></p>
    </div>
  </div>

  <?php echo CHtml::beginForm(); ?>

  <div class="form-group">
    <?php echo CHtml::label('Reply Message', 'reply_message'); ?>
    <?php echo CHtml::textArea('Inquiries[reply_message]', $model->reply_message, ['class' => 'form-control', 'rows' => 5]); ?>
  </div>

  <button type="submit" class="btn btn-primary">Send Reply</button>
  <a href="<?php echo $this->createUrl('inquiries/index'); ?>" class="btn btn-secondary">Back</a>

  <?php echo CHtml::endForm(); ?>
</div>
