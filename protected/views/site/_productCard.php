<?php /** @var Products $data */ ?>

<div class="col-6 col-sm-4 col-md-3 mb-3">
  <div class="product-card card h-100 border-0 shadow-sm">

    <div class="product-image-wrapper">
      <img src="<?php echo !empty($data->image_url)
        ? Yii::app()->baseUrl . $data->image_url
        : Yii::app()->baseUrl . '/images/no-image.jpg'; ?>"
        alt="<?php echo CHtml::encode($data->name); ?>"
        class="card-img-top product-image">
    </div>

    <div class="card-body p-2 d-flex flex-column">
      <div class="product-title" title="<?php echo CHtml::encode($data->name); ?>">
        <?php echo CHtml::encode($data->name); ?>
      </div>

      <div class="product-price">
        ₱<?php echo number_format($data->price, 2); ?>
      </div>

      <?php if (!empty($data->category)): ?>
        <div class="product-category">
          <?php echo CHtml::encode($data->category); ?>
        </div>
      <?php endif; ?>

      <a href="<?php echo Yii::app()->createUrl('products/view', ['id' => $data->id]); ?>"
         class="btn btn-sm btn-outline-primary mt-auto">View</a>
    </div>

  </div>
</div>
