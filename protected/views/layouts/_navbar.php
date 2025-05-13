<?php
$role = Yii::app()->user->getState('role');
$userName = CHtml::encode(Yii::app()->user->name);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-orange shadow-sm">
  <div class="container">
    <a class="navbar-brand font-weight-bold" href="<?php echo Yii::app()->homeUrl; ?>">KSC Marketplace</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">

        <?php if (Yii::app()->user->isGuest): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $this->createUrl('site/login'); ?>">
              <i class="bi bi-person-circle text-white mr-1"></i> Login/Register
            </a>
          </li>
        <?php else: ?>

          <?php if ($role === 'buyer'): ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="<?php echo $this->createUrl('buyer/dashboard'); ?>">
                <i class="bi bi-grid-fill mr-1"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="<?php echo $this->createUrl('inquiries/my'); ?>">
                <i class="bi bi-chat-dots-fill"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="<?php echo $this->createUrl('cart/index'); ?>">
                <i class="bi bi-cart-fill"></i>
              </a>
            </li>

          <?php elseif ($role === 'seller'): ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="<?php echo $this->createUrl('seller/dashboard'); ?>">
                <i class="bi bi-grid-fill mr-1"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="<?php echo $this->createUrl('inquiries/index'); ?>">
                <i class="bi bi-chat-dots-fill"></i>
              </a>
            </li>

          <?php elseif ($role === 'admin'): ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="<?php echo $this->createUrl('admin/index'); ?>">
                <i class="bi bi-bar-chart-fill mr-1"></i> Admin Panel
              </a>
            </li>
          <?php endif; ?>

          <!-- User Dropdown -->
          <li class="nav-item dropdown ml-2">
            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="userDropdown"
               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bi bi-person-circle text-white mr-1"></i> <?php echo $userName; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="userDropdown">

              <?php if ($role === 'buyer'): ?>
                <a class="dropdown-item" href="<?php echo $this->createUrl('orders/index'); ?>">
                  <i class="bi bi-bag-check mr-1"></i> My Orders
                </a>
              <?php elseif ($role === 'seller'): ?>
                <a class="dropdown-item" href="<?php echo $this->createUrl('products/index'); ?>">
                  <i class="bi bi-box-seam mr-1"></i> Products
                </a>
                <a class="dropdown-item" href="<?php echo $this->createUrl('seller/orders'); ?>">
                  <i class="bi bi-receipt mr-1"></i> Orders
                </a>
              <?php endif; ?>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="<?php echo $this->createUrl('site/logout'); ?>">
                <i class="bi bi-box-arrow-right mr-1"></i> Logout
              </a>
            </div>
          </li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
