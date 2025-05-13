<?php
/** @var CActiveDataProvider $dataProvider */
?>

<section class="product-list-section">
  <div class="container">
    <h3 class="section-title">Daily Discover</h3>

    <?php $this->widget('zii.widgets.CListView', [
      'dataProvider' => $dataProvider,
      'itemView' => '//site/_productCard',
      'summaryText' => '',
      'emptyText' => '<p class="text-muted">No products available at the moment.</p>',
      'itemsCssClass' => 'row product-grid',
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
</section>
