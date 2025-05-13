<?php
$this->pageTitle = 'Create Company Profile';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/companies/create.css" rel="stylesheet">

<div class="container mt-5">
  <h2 class="mb-4 text-orange">Create Company Profile</h2>

  <?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>
