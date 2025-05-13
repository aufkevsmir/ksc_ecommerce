<?php
$this->pageTitle = 'Edit User';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
  <div class="section-card compact-card">

    <h2 class="mb-4 text-danger">Edit User</h2>

    <?php echo CHtml::beginForm(); ?>

    <div class="form-group">
      <label>Full Name</label>
      <?php echo CHtml::activeTextField($model, 'full_name', ['class' => 'form-control']); ?>
    </div>

    <div class="form-group">
      <label>Email</label>
      <?php echo CHtml::activeTextField($model, 'email', ['class' => 'form-control']); ?>
    </div>

    <div class="form-group">
      <label>Role</label>
      <?php echo CHtml::activeDropDownList($model, 'role', [
        'buyer' => 'Buyer',
        'seller' => 'Seller',
        'admin' => 'Admin'
      ], ['class' => 'form-control']); ?>
    </div>

    <div class="d-flex justify-content-between mt-4">
      <a href="<?php echo $this->createUrl('admin/users'); ?>" class="btn btn-secondary">Cancel</a>
      <?php echo CHtml::submitButton('Save Changes', ['class' => 'btn btn-danger']); ?>
    </div>

    <?php echo CHtml::endForm(); ?>
  </div>
</div>
