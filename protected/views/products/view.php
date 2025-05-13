<?php
$this->pageTitle = CHtml::encode($model->name);
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/products/view.css">

<div class="container mt-4">
  <div class="product-card shadow-sm p-4 bg-white border rounded">


  <!-- Product Header -->
  <div class="row mb-4">
    <!-- Image -->
    <div class="col-md-5 text-center">
      <img src="<?php echo !empty($model->image_url)
        ? Yii::app()->baseUrl . $model->image_url
        : Yii::app()->baseUrl . '/images/no-image.jpg'; ?>"
        alt="<?php echo CHtml::encode($model->name); ?>"
        class="product-image img-fluid rounded border">
    </div>

    <!-- Info -->
    <div class="col-md-7">
      <h3 class="product-title"><?php echo CHtml::encode($model->name); ?></h3>
      <h4 class="product-price">₱<?php echo number_format($model->price, 2); ?></h4>

      <ul class="product-meta list-unstyled small mb-4">
        <li><strong>Category:</strong> <?php echo CHtml::encode($model->category); ?></li>
        <li><strong>Stock:</strong> <?php echo CHtml::encode($model->stock); ?></li>
        <li><strong>Seller:</strong> <?php echo CHtml::encode($model->company->user->full_name); ?></li>
      </ul>

      <?php if (!Yii::app()->user->isGuest && Yii::app()->user->role === 'buyer'): ?>
        <div class="d-flex flex-wrap align-items-center">
          <a href="<?php echo $this->createUrl('cart/add', ['id' => $model->id]); ?>"
             class="btn btn-orange mr-2 mb-2">
            <i class="bi bi-cart-fill mr-1"></i> Add to Cart
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Seller Panel -->
  <div class="seller-panel d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center">
      <img src="<?php echo Yii::app()->baseUrl; ?>/images/no-image.jpg" alt="Seller Logo" class="seller-logo rounded mr-3">
      <strong><?php echo CHtml::encode($model->company->name); ?></strong>
    </div>

    <?php if (!Yii::app()->user->isGuest && Yii::app()->user->role === 'buyer'): ?>
      <a href="<?php echo $this->createUrl('inquiries/create', ['product_id' => $model->id]); ?>"
         class="btn btn-outline-orange">
        <i class="bi bi-chat-dots mr-1"></i> Send Inquiry
      </a>
    <?php endif; ?>
  </div>

  <!-- Description -->
  <div class="product-description mb-5">
    <h5 class="mb-3">Product Description</h5>
    <p><?php echo nl2br(CHtml::encode($model->description)); ?></p>
  </div>

  <!-- Inquiries -->
  <div class="product-inquiries mb-5">
    <h5 class="mb-3">Recent Inquiries</h5>
    <?php if (!empty($inquiries)): ?>
      <ul class="list-group">
        <?php foreach ($inquiries as $inq): ?>
          <li class="list-group-item">
            <strong><?php echo CHtml::encode($inq->buyer->full_name); ?></strong>
            <small class="text-muted float-right"><?php echo date('M j, Y g:i A', strtotime($inq->created_at)); ?></small>
            <p class="mb-0 mt-2"><?php echo nl2br(CHtml::encode($inq->message)); ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p class="text-muted">No inquiries yet for this product.</p>
    <?php endif; ?>
  </div>

</div>
