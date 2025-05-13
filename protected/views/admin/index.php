<?php
$this->pageTitle = 'Admin Dashboard';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/admin/index.css" rel="stylesheet">

<div class="container mt-4">
  <div class="section-card compact-card admin-dashboard">

    <h2 class="mb-4 text-danger">Welcome, KSC Admin!</h2>

    <div class="row">
      <?php
      $cards = [
        [
          'label' => 'Manage Users',
          'count' => Users::model()->count(),
          'icon' => 'bi-people-fill',
          'url' => $this->createUrl('admin/users'),
        ],
        [
          'label' => 'Manage Companies',
          'count' => Companies::model()->count(),
          'icon' => 'bi-building',
          'url' => $this->createUrl('admin/companies'),
        ],
        [
          'label' => 'Manage Products',
          'count' => Products::model()->count(),
          'icon' => 'bi-box-seam',
          'url' => $this->createUrl('admin/products'),
        ],
        [
          'label' => 'Manage Orders',
          'count' => Orders::model()->count(),
          'icon' => 'bi-receipt-cutoff',
          'url' => $this->createUrl('admin/orders'),
        ],
        [
          'label' => 'Manage Inquiries',
          'count' => Inquiries::model()->count(),
          'icon' => 'bi-chat-dots',
          'url' => $this->createUrl('admin/inquiries'),
        ],
        [
          'label' => 'Transactions',
          'count' => Transactions::model()->count(),
          'icon' => 'bi-currency-exchange',
          'url' => $this->createUrl('admin/transactions'),
        ],
      ];

      foreach ($cards as $card): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
              <div class="text-orange mb-2">
                <i class="bi <?php echo $card['icon']; ?> display-4"></i>
              </div>
              <h5 class="card-title font-weight-bold"><?php echo $card['label']; ?></h5>
              <p class="text-muted mb-3">Total: <strong><?php echo $card['count']; ?></strong></p>
              <a href="<?php echo $card['url']; ?>" class="btn btn-orange px-4">
                <i class="bi bi-box-arrow-in-right mr-1"></i> Open
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</div>
