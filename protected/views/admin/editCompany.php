<?php
$this->pageTitle = 'Edit Company';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h3 class="card-title text-danger mb-4">Edit Company</h3>

      <?php echo CHtml::beginForm(); ?>

      <div class="form-group">
        <label for="Companies_name">Company Name</label>
        <?php echo CHtml::activeTextField($model, 'name', ['class' => 'form-control']); ?>
      </div>

      <div class="form-group">
        <label for="Companies_address">Address</label>
        <?php echo CHtml::activeTextField($model, 'address', ['class' => 'form-control']); ?>
      </div>

      <div class="form-group">
        <label for="Companies_industry">Industry</label>
        <?php echo CHtml::activeTextField($model, 'industry', ['class' => 'form-control']); ?>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <a href="<?php echo $this->createUrl('admin/companies'); ?>" class="btn btn-secondary">Cancel</a>
        <?php echo CHtml::submitButton('Save Changes', ['class' => 'btn btn-danger']); ?>
      </div>

      <?php echo CHtml::endForm(); ?>
    </div>
  </div>
</div>
