<div class="container mt-4">
  <div class="section-card compact-card">

    <h1 class="h4 font-weight-bold mb-4">Welcome, <?php echo CHtml::encode(Yii::app()->user->name); ?>!</h1>

    <!-- Summary Cards in Section Card -->
    <div class="section-card compact-card bg-light mb-4">
      <div class="row text-center">
        <div class="col-md-4 mb-3">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h6 class="text-muted">Total Products</h6>
              <h3 class="font-weight-bold"><?php echo $productCount; ?></h3>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h6 class="text-muted">Total Orders</h6>
              <h3 class="font-weight-bold"><?php echo $orderCount; ?></h3>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h6 class="text-muted">Pending Inquiries</h6>
              <h3 class="font-weight-bold"><?php echo $inquiryCount; ?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="section-card compact-card bg-light">
      <div class="d-flex flex-wrap gap-3">
        <a href="<?php echo Yii::app()->createUrl('products/create'); ?>" class="btn btn-success mr-2 mb-2">
          Upload Product
        </a>
        <a href="<?php echo Yii::app()->createUrl('products/index'); ?>" class="btn btn-primary mr-2 mb-2">
          Manage Products
        </a>
        <a href="<?php echo Yii::app()->createUrl('seller/orders'); ?>" class="btn btn-outline-secondary mr-2 mb-2">
          View Orders
        </a>
        <a href="<?php echo Yii::app()->createUrl('inquiries/index'); ?>" class="btn btn-outline-secondary mb-2">
          View Inquiries
        </a>
      </div>
    </div>

  </div>
</div>
