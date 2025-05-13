<?php /** @var Companies $data */ ?>

<div class="col-md-4 mb-4">
  <div class="card h-100 shadow-sm">
    <div class="card-body">
      <h5 class="card-title font-weight-bold mb-2">
        <?php echo CHtml::encode($data->name); ?>
      </h5>
      <ul class="list-unstyled small text-muted mb-2">
        <li><strong>Company ID:</strong> <?php echo $data->id; ?></li>
        <li><strong>Owner User ID:</strong> <?php echo $data->user_id; ?></li>
        <li><strong>Created:</strong> <?php echo CHtml::encode(date('Y-m-d', strtotime($data->created_at))); ?></li>
      </ul>
    </div>
    <div class="card-footer bg-white text-right">
      <a href="<?php echo Yii::app()->createUrl('admin/editCompany', ['id' => $data->id]); ?>"
         class="btn btn-sm btn-outline-primary">
        Edit
      </a>
    </div>
  </div>
</div>
