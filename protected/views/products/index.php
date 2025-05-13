<?php
$this->pageTitle = 'My Products';
?>

<!-- Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/products/index.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/components/pagination.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/site/index.css" rel="stylesheet">

<!-- Container -->
<div class="container mt-4">
  <div class="section-card compact-card">

    <h2 class="mb-4 text-danger">My Products</h2>

    <?php $this->widget('zii.widgets.CListView', [
      'dataProvider' => $dataProvider,
      'itemView' => '_item',
      'itemsTagName' => 'div',
      'itemsCssClass' => 'row',
      'summaryText' => '',
      'emptyText' => '<p class="text-muted">You have no products.</p>',
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
     aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="deleteForm" method="post" action="">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Deletion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this product?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Modal Script -->
<script>
  $('#deleteModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const productId = button.data('id');
    const actionUrl = '<?php echo Yii::app()->createUrl("/products/delete"); ?>/' + productId;
    $('#deleteForm').attr('action', actionUrl);
  });
</script>
