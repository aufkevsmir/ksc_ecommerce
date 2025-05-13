<?php
$this->pageTitle = 'Welcome to KSC Marketplace';
?>

<link href="<?php echo Yii::app()->baseUrl; ?>/css/site/index.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/components/productCard.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/components/pagination.css" rel="stylesheet">

<div class="homepage-wrapper">

  <!-- Hero Section Card -->
  <div class="section-card hero-card mb-4">
    <section class="hero-section text-center">
      <h1 class="hero-title">KSC B2B Marketplace</h1>
      <p class="hero-subtitle">Your trusted platform to source, sell, and scale in the industrial marketplace.</p>
      <a href="<?php echo Yii::app()->createUrl('site/login'); ?>" class="btn btn-cta">Get Started</a>
      <div class="hero-bg"></div>
    </section>
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
