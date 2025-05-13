<?php
$this->pageTitle = 'Welcome to KSC Marketplace';
?>

<link href="<?php echo Yii::app()->baseUrl; ?>/css/site/index.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/components/productCard.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/components/pagination.css" rel="stylesheet">

<div class="homepage-wrapper">

  <!-- Hero Section Card -->
  <!-- Shopee-style Hero Layout -->
<div class="container mb-4">
  <div class="row">
    <!-- Left: Carousel -->
    <div class="col-md-8">
      <div id="heroCarousel" class="carousel slide shadow-sm" data-ride="carousel">
        <div class="carousel-inner rounded">
          <div class="carousel-item active">
            <img src="<?php echo Yii::app()->baseUrl; ?>/images/banners/hero1.png" class="d-block w-100" alt="Slide 1">
          </div>
          <div class="carousel-item">
            <img src="<?php echo Yii::app()->baseUrl; ?>/images/banners/hero2.png" class="d-block w-100" alt="Slide 2">
          </div>
        </div>
        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>
    </div>

    <!-- Right: Static Promos -->
    <div class="col-md-4 d-flex flex-column justify-content-between">
      <div class="mb-3">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/banners/promo1.png" class="img-fluid rounded shadow-sm" alt="Promo 1">
      </div>
      <div>
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/banners/promo2.png" class="img-fluid rounded shadow-sm" alt="Promo 2">
      </div>
    </div>
  </div>
</div>

  <!-- Categories Section Card -->
  <div class="section-card compact-card mb-4">
    <section class="category-section">
      <h3 class="section-title">Shop by Category</h3>
      <div class="row text-center">
        <?php foreach ($categories as $label => $icon): ?>
          <?php
            $isActive = isset($selectedCategory) && $selectedCategory === $label;
            $imagePath = Yii::app()->baseUrl . '/images/category-icons/' . CHtml::encode($icon);
          ?>
          <div class="col-6 col-sm-4 col-md-3 mb-4">
            <a href="<?php echo $this->createUrl('site/index', ['category' => $label]); ?>"
              class="category-tile<?php echo $isActive ? ' active' : ''; ?>">
              <img src="<?php echo $imagePath; ?>"
                   alt="<?php echo CHtml::encode($label); ?>"
                   class="category-icon">
              <div class="category-label"><?php echo CHtml::encode($label); ?></div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </div>

  <!-- Category Filter Label (if any) -->
  <?php if (!empty($selectedCategory)): ?>
    <div class="container mb-4">
      <h5 class="text-muted">
        Showing results for category:
        <span class="font-weight-bold"><?php echo CHtml::encode($selectedCategory); ?></span>
        <a href="<?php echo $this->createUrl('site/index'); ?>" class="ml-2 btn btn-sm btn-outline-secondary">Clear</a>
      </h5>
    </div>
  <?php endif; ?>

  <!-- Product Grid Card -->
  <div class="section-card compact-card">
    <?php $this->renderPartial('//site/_homeGrid', ['dataProvider' => $dataProvider]); ?>
  </div>

</div>
