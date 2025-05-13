<?php /** @var Users $data */ ?>

<div class="col-md-4 mb-4">
  <div class="card h-100 shadow-sm">
    <div class="card-body">
      <h5 class="card-title font-weight-bold mb-2">
        <?php echo CHtml::encode($data->full_name); ?>
      </h5>
      <p class="mb-1">
        <small class="text-muted">User ID:</small> <?php echo $data->id; ?><br>
        <small class="text-muted">Email:</small> <?php echo CHtml::encode($data->email); ?><br>
        <small class="text-muted">Role:</small> <?php echo ucfirst($data->role); ?><br>
        <small class="text-muted">Joined:</small> <?php echo date('Y-m-d', strtotime($data->created_at)); ?>
      </p>
    </div>
    <div class="card-footer bg-white text-right">
      <a href="<?php echo Yii::app()->createUrl('admin/editUser', ['id' => $data->id]); ?>"
         class="btn btn-sm btn-outline-primary">
        Edit
      </a>
    </div>
  </div>
</div>
