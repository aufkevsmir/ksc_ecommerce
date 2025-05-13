<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>

  <!-- Bootstrap + Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/components/navbar.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/components/footer.css">



  <!-- Core Layout Styles -->
  <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/layout/main.css">

  <!-- Component Styles -->
  <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/components/productCard.css">

  <!-- Scoped Inline Overrides -->
  <style>
    .nav-icon {
      width: 20px;
      height: 20px;
      object-fit: contain;
      margin-right: 6px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<?php $this->renderPartial('//layouts/_navbar'); ?>

<!-- Flash Messages -->
<div class="container mt-3">
  <?php foreach (Yii::app()->user->getFlashes() as $key => $message): ?>
    <div class="alert alert-<?php echo $key; ?> alert-dismissible fade show" role="alert">
      <?php echo $message; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endforeach; ?>
</div>

<!-- Main Content -->
<main class="container my-4">
  <?php echo $content; ?>
</main>


<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
