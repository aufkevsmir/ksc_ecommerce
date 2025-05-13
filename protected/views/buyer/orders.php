<?php
$this->pageTitle = 'My Orders';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
  <h2 class="mb-4 text-orange">My Orders</h2>

  <?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_order_card',
    'summaryText' => '',
    'emptyText' => '<p class="text-muted">You have no orders yet.</p>',
    'itemsCssClass' => 'list-group',
  )); ?>
</div>
