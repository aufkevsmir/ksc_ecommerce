<div class="container mt-4">
  <div class="section-card compact-card">

    <h1 class="h4 font-weight-bold mb-4">Welcome, <?php echo CHtml::encode(Yii::app()->user->name); ?>!</h1>

    <!-- Metrics + Recents Grid -->
    <div class="row">

      <!-- Products Summary -->
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h6 class="text-muted">Total Products</h6>
            <h3 class="font-weight-bold"><?php echo $productCount; ?></h3>
            <ul class="list-unstyled mt-3 mb-0">
              <?php foreach (array_slice($products, 0, 3) as $p): ?>
                <li class="small text-truncate">
                  <i class="bi bi-box mr-1 text-muted"></i>
                  <?php echo CHtml::encode($p->name); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>

      <!-- Orders Summary -->
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h6 class="text-muted">Total Orders</h6>
            <h3 class="font-weight-bold"><?php echo $orderCount; ?></h3>
            <ul class="list-unstyled mt-3 mb-0">
              <?php foreach (array_slice($recentOrders, 0, 3) as $o): ?>
                <li class="small text-truncate">
                  <i class="bi bi-receipt mr-1 text-muted"></i>
                  Order #<?php echo $o->id; ?> —
                  <span class="text-muted"><?php echo CHtml::encode($o->buyer->full_name); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>

      <!-- Inquiries Summary -->
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h6 class="text-muted">Pending Inquiries</h6>
            <h3 class="font-weight-bold"><?php echo $inquiryCount; ?></h3>
            <ul class="list-unstyled mt-3 mb-0">
              <?php foreach (array_slice($recentInquiries, 0, 3) as $inq): ?>
                <li class="small text-truncate">
                  <i class="bi bi-question-circle mr-1 text-muted"></i>
                  <?php echo CHtml::encode($inq->buyer->full_name); ?> –
                  <span class="text-muted"><?php echo CHtml::encode($inq->product->name); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>

    </div>

    <!-- Quick Actions -->
    <div class="text-center mt-4">
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
