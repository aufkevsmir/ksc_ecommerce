<?php
$this->pageTitle = 'Checkout';
Yii::app()->clientScript->registerScriptFile('https://js.stripe.com/v3/');
?>

<div class="container mt-5 mb-5">
  <h4 class="mb-4 font-weight-bold text-shopee">Checkout</h4>

  <!-- ✅ Form now posts to orders/checkout -->
  <form id="payment-form" method="POST" action="<?php echo Yii::app()->createUrl('orders/checkout'); ?>">

    <!-- 🛒 Product Summary -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="mb-3">Items in Your Order</h5>

        <?php foreach ($cartItems as $item): ?>
          <div class="row mb-3">
            <div class="col-3 col-md-2 text-center">
              <img src="<?php echo !empty($item->product->image_url)
                ? Yii::app()->baseUrl . $item->product->image_url
                : Yii::app()->baseUrl . '/images/no-image.jpg'; ?>"
                class="img-fluid rounded" style="max-height: 60px;">
            </div>
            <div class="col-9 col-md-6">
              <div class="font-weight-bold"><?php echo CHtml::encode($item->product->name); ?></div>
              <div class="text-muted small">Qty: <?php echo $item->quantity; ?></div>
            </div>
            <div class="col-12 col-md-4 text-md-right font-weight-bold text-shopee">
              ₱<?php echo number_format($item->product->price * $item->quantity, 2); ?>
            </div>
          </div>
        <?php endforeach; ?>

        <hr>
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Total:</h5>
          <h4 class="text-shopee mb-0">₱<?php echo number_format($totalAmount, 2); ?></h4>
        </div>
      </div>
    </div>

    <!-- 💳 Stripe Card Form -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="mb-3">Payment</h5>
        <label for="card-element">Credit or debit card</label>
        <div id="card-element" class="form-control">
          <!-- Stripe Element will mount here -->
        </div>
        <div id="card-errors" class="text-shopee mt-2" role="alert"></div>
      </div>
    </div>

    <!-- Hidden Stripe Token + Amount -->
    <input type="hidden" name="amount" value="<?php echo $totalAmount; ?>">
    <input type="hidden" name="stripeToken" id="stripeToken">

    <!-- Submit Button -->
    <button class="btn btn-shopee btn-lg btn-block font-weight-bold" type="submit" id="submit-button">
      Pay Now
    </button>
  </form>
</div>

<!-- Stripe JS Script -->
<script>
  const stripe = Stripe('<?php echo Yii::app()->params["stripePublishableKey"]; ?>');
  const elements = stripe.elements();
  const style = {
    base: {
      fontSize: '16px',
      color: '#32325d',
    },
  };

  const card = elements.create('card', { style });
  card.mount('#card-element');

  card.on('change', function(event) {
    const displayError = document.getElementById('card-errors');
    displayError.textContent = event.error ? event.error.message : '';
  });

  const form = document.getElementById('payment-form');
  form.addEventListener('submit', async function(event) {
    event.preventDefault();
    document.getElementById('submit-button').disabled = true;

    const { token, error } = await stripe.createToken(card);

    if (error) {
      document.getElementById('card-errors').textContent = error.message;
      document.getElementById('submit-button').disabled = false;
    } else {
      document.getElementById('stripeToken').value = token.id;
      form.submit();
    }
  });
</script>
