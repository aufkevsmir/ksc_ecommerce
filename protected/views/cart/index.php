<?php $this->pageTitle = 'Shopping Cart'; ?>

<!-- Styles -->
<link href="<?php echo Yii::app()->baseUrl; ?>/css/site/index.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/css/cart/index.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-4">
  <div class="section-card compact-card">

    <h4 class="mb-4 font-weight-bold text-danger">Shopping Cart</h4>

    <?php if (empty($cartItems)): ?>
      <p class="text-muted">Your cart is empty.</p>
    <?php else: ?>
      <?php echo CHtml::beginForm('', 'post', ['id' => 'cartForm']); ?>
      <div class="cart-items border-top">

        <?php $total = 0; ?>
        <?php foreach ($cartItems as $item): ?>
          <?php
            $product = $item->product;
            $subtotal = $item->quantity * $product->price;
            $total += $subtotal;
          ?>

          <div class="cart-item row align-items-center py-3 border-bottom">
            <!-- Image -->
            <div class="col-3 col-md-2 text-center">
              <img src="<?php echo !empty($product->image_url)
                ? Yii::app()->baseUrl . $product->image_url
                : Yii::app()->baseUrl . '/images/no-image.jpg'; ?>"
                class="img-fluid rounded" style="max-height: 80px;">
            </div>

            <!-- Product Details -->
            <div class="col-9 col-md-4">
              <div class="font-weight-bold mb-1"><?php echo CHtml::encode($product->name); ?></div>
              <div class="text-muted small">Category: <?php echo CHtml::encode($product->category); ?></div>
            </div>

            <!-- Price -->
            <div class="col-4 col-md-2 text-danger font-weight-bold">
              ₱<?php echo number_format($product->price, 2); ?>
            </div>

            <!-- Quantity -->
            <div class="col-4 col-md-2">
              <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-outline-secondary" onclick="adjustQty(this, -1)">−</button>
                </div>
                <?php echo CHtml::textField("Cart[{$item->id}][quantity]", $item->quantity, [
                  'class' => 'form-control text-center qty-input',
                  'min' => 1,
                ]); ?>
                <div class="input-group-append">
                  <button type="button" class="btn btn-outline-secondary" onclick="adjustQty(this, 1)">+</button>
                </div>
              </div>
            </div>

            <!-- Subtotal + Action -->
            <div class="col-4 col-md-2 text-right">
              <div class="text-danger font-weight-bold">
                ₱<?php echo number_format($subtotal, 2); ?>
              </div>
              <button type="button" class="btn btn-link text-danger p-0 small mt-1"
                      data-toggle="modal" data-target="#deleteModal"
                      data-id="<?php echo $item->id; ?>">
                <small>Remove</small>
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Total and Checkout -->
      <div class="checkout-bar bg-light p-3 d-flex justify-content-between align-items-center border-top mt-3">
        <div class="font-weight-bold text-muted">Total:</div>
        <div class="d-flex align-items-center">
          <h5 class="text-danger font-weight-bold mb-0 mr-3">₱<?php echo number_format($total, 2); ?></h5>
          <?php echo CHtml::submitButton('Update Cart', ['class' => 'btn btn-outline-secondary btn-sm mr-2']); ?>
          <a href="<?php echo $this->createUrl('buyer/checkout'); ?>" class="btn btn-danger btn-sm px-4">
            Checkout
          </a>
        </div>
      </div>

      <?php echo CHtml::endForm(); ?>
    <?php endif; ?>

  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="deleteForm" method="post" action="">
        <div class="modal-header">
          <h5 class="modal-title">Remove Item</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">Are you sure you want to remove this product?</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Remove</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function adjustQty(button, delta) {
    const input = $(button).closest('.input-group').find('.qty-input');
    let current = parseInt(input.val(), 10) || 1;
    const updated = Math.max(1, current + delta);
    input.val(updated);
  }

  $('#deleteModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const itemId = button.data('id');
    const actionUrl = '<?php echo Yii::app()->createUrl("cart/remove"); ?>/' + itemId;
    $('#deleteForm').attr('action', actionUrl);
  });
</script>
