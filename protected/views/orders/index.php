<?php
$this->pageTitle = 'My Orders';
?>
<link href="<?php echo Yii::app()->baseUrl; ?>/css/components/pagination.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/site/index.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4 mb-5">
  <div class="section-card compact-card">

    <h4 class="mb-4 font-weight-bold text-danger">My Orders</h4>

    <?php $this->widget('zii.widgets.CListView', [
      'dataProvider' => $dataProvider,
      'itemView' => '_orderCard',
      'itemsTagName' => 'div',
      'itemsCssClass' => '',
      'summaryText' => '',
      'emptyText' => '<p class="text-muted">You haven\'t placed any orders yet.</p>',
      'pagerCssClass' => 'd-flex justify-content-center mt-4',
      'pager' => [
        'class' => 'CLinkPager',
        'header' => '',
        'htmlOptions' => ['class' => 'pagination'],
        'firstPageLabel' => '«',
        'lastPageLabel' => '»',
        'prevPageLabel' => '‹',
        'nextPageLabel' => '›',
        'selectedPageCssClass' => 'active',
        'hiddenPageCssClass' => 'disabled',
        'maxButtonCount' => 5,
      ],
    ]); ?>

  </div>
</div>
