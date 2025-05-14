<!-- Shopee-style Footer with Card -->
<footer class="footer-section mt-5">
  <div class="section-card compact-card pt-4 pb-3">
    <div class="container">
      <div class="row text-left">

        <!-- Customer Service -->
        <div class="col-6 col-md-3 mb-4">
          <h6 class="font-weight-bold text-uppercase small">Customer Service</h6>
          <ul class="list-unstyled small mb-0">
            <li>Help Centre</li>
            <li>Payment Methods</li>
            <li>Order Tracking</li>
            <li>Return & Refund</li>
            <li>Contact Us</li>
          </ul>
        </div>

        <!-- About -->
        <div class="col-6 col-md-3 mb-4">
          <h6 class="font-weight-bold text-uppercase small">About</h6>
          <ul class="list-unstyled small mb-0">
            <li>About Us</li>
            <li>Seller Centre</li>
            <li>Privacy Policy</li>
            <li>Media Contact</li>
          </ul>
        </div>

        <!-- Payment Methods -->
        <div class="col-6 col-md-3 mb-4">
          <h6 class="font-weight-bold text-uppercase small">Payment</h6>
          <div class="d-flex flex-wrap align-items-center">
            <?php foreach (['visa', 'mastercard', 'stripe'] as $icon): ?>
              <img src="<?php echo Yii::app()->baseUrl; ?>/images/payment/<?php echo $icon; ?>.png"
                   alt="<?php echo $icon; ?>"
                   class="mr-2 mb-2"
                   style="height: 24px;">
            <?php endforeach; ?>
          </div>
        </div>

        <!-- App Download -->
        <div class="col-6 col-md-3 mb-4">
          <h6 class="font-weight-bold text-uppercase small">App Download</h6>
          <img src="<?php echo Yii::app()->baseUrl; ?>/images/qr.png"
               class="img-fluid rounded mb-2"
               style="max-width: 100px;" alt="QR Code">
          <div>
            <?php foreach (['appstore', 'googleplay'] as $store): ?>
              <img src="<?php echo Yii::app()->baseUrl; ?>/images/stores/<?php echo $store; ?>.png"
                   class="mr-2 mb-1"
                   style="height: 20px;" alt="<?php echo $store; ?>">
            <?php endforeach; ?>
          </div>
        </div>

      </div>

      <hr>
      <div class="d-flex justify-content-between small text-muted">
        <div>&copy; 2025 KSC. All Rights Reserved.</div>
        <div>Region: Philippines</div>
      </div>
    </div>
  </div>
</footer>
