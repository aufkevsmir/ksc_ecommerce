<?php
$this->pageTitle = 'Manage Companies';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/admin/index.css" rel="stylesheet">

<div class="container mt-4">
  <div class="section-card compact-card">
    <h2 class="mb-4 text-danger">Manage Companies</h2>

    <?php $this->widget('zii.widgets.CListView', [
      'dataProvider' => $dataProvider,
      'itemView' => '_companyCard',
      'itemsTagName' => 'div',
      'itemsCssClass' => 'row',
      'summaryText' => '',
      'emptyText' => '<p class="text-muted">No companies found.</p>',
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
