<?php
$this->pageTitle = 'Update Order Status';
?>

<div class="container mt-4">
  <h2 class="mb-4 text-orange">Update Order Status - #<?php echo $order->id; ?></h2>

  <?php echo CHtml::beginForm(); ?>

  <div class="form-group">
    <label>Status</label>
    <?php echo CHtml::dropDownList('status', $order->status, [
      'pending' => 'Pending',
      'shipped' => 'Shipped',
      'completed' => 'Completed',
    ], ['class' => 'form-control']); ?>
  </div>

  <?php echo CHtml::submitButton('Update Status', ['class' => 'btn btn-orange']); ?>
  <?php echo CHtml::endForm(); ?>
</div>
