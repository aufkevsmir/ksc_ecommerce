<?php /** @var Products $data */ ?>

<div class="col-6 col-sm-4 col-md-3 mb-4">
  <div class="card product-card h-100 shadow-sm">

    <!-- Image -->
    <img src="<?php echo !empty($data->image_url)
      ? Yii::app()->baseUrl . $data->image_url
      : Yii::app()->baseUrl . '/images/no-image.jpg'; ?>"
      alt="<?php echo CHtml::encode($data->name); ?>"
      class="card-img-top"
      style="height: 140px; object-fit: cover;">

    <!-- Body -->
    <div class="card-body p-2 d-flex flex-column">
      <h6 class="card-title text-truncate mb-1"><?php echo CHtml::encode($data->name); ?></h6>
      <div class="text-danger font-weight-bold mb-2">₱<?php echo number_format($data->price, 2); ?></div>

      <!-- Action Buttons -->
      <div class="mt-auto d-flex justify-content-between">
        <!-- Edit -->
        <a href="<?php echo Yii::app()->createUrl('products/update', ['id' => $data->id]); ?>"
           class="btn btn-sm btn-outline-primary" title="Edit">
          <i class="bi bi-pencil"></i>
        </a>

        <!-- Delete -->
        <form method="post"
              action="<?php echo Yii::app()->createUrl('products/delete', ['id' => $data->id]); ?>"
              onsubmit="return confirm('Are you sure you want to delete this product?');"
              style="display:inline;">
          <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
            <i class="bi bi-trash"></i>
          </button>
        </form>

      </div>
    </div>
  </div>
</div>
