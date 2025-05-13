<?php
$this->pageTitle = 'Buyer Inquiries';
?>
<link href="<?php echo Yii::app()->baseUrl; ?>/css/site/index.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/components/pagination.css" rel="stylesheet">

<div class="container mt-4">
  <div class="section-card compact-card">

    <h2 class="mb-4 text-danger">Inquiries from Buyers</h2>

    <?php if ($dataProvider->totalItemCount === 0): ?>
      <p class="text-muted">No inquiries received yet.</p>
    <?php else: ?>
      <?php foreach ($dataProvider->getData() as $inquiry): ?>
        <div class="border rounded p-3 mb-3 bg-light">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
              <strong>Product:</strong> <?php echo CHtml::encode($inquiry->product->name); ?>
            </div>
            <small class="text-muted"><?php echo date('F j, Y g:i A', strtotime($inquiry->created_at)); ?></small>
          </div>

          <p class="mb-1"><strong>From Buyer:</strong> <?php echo CHtml::encode($inquiry->buyer->full_name); ?></p>
          <p class="mb-2"><strong>Message:</strong><br><?php echo nl2br(CHtml::encode($inquiry->message)); ?></p>

          <p class="mb-2"><strong>Status:</strong>
            <span class="badge badge-<?php echo $inquiry->status === 'responded' ? 'success' : 'secondary'; ?>">
              <?php echo ucfirst($inquiry->status); ?>
            </span>
          </p>

          <?php if ($inquiry->reply_message): ?>
            <div class="bg-white p-3 rounded border mt-3">
              <p class="mb-1"><strong>Your Reply:</strong></p>
              <p class="mb-0"><?php echo nl2br(CHtml::encode($inquiry->reply_message)); ?></p>
            </div>
          <?php else: ?>
            <div class="mt-3">
              <a href="<?php echo $this->createUrl('inquiries/reply', ['id' => $inquiry->id]); ?>" class="btn btn-sm btn-primary">
                Reply
              </a>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>

      <!-- Pagination -->
      <div class="d-flex justify-content-center mt-4">
        <?php $this->widget('CLinkPager', [
          'pages' => $dataProvider->pagination,
          'header' => '',
          'htmlOptions' => ['class' => 'pagination'],
          'firstPageLabel' => '«',
          'lastPageLabel' => '»',
          'prevPageLabel' => '‹',
          'nextPageLabel' => '›',
          'selectedPageCssClass' => 'active',
          'hiddenPageCssClass' => 'disabled',
          'maxButtonCount' => 5,
        ]); ?>
      </div>
    <?php endif; ?>

  </div>
</div>
