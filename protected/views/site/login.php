<?php
$this->pageTitle = 'Login / Register';
?>

<!-- Bootstrap + Login CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="<?php echo Yii::app()->baseUrl; ?>/css/site/login.css" rel="stylesheet">

<div class="container mt-5">
  <div class="section-card compact-card auth-container mx-auto">

    <!-- LEFT PANEL (Text + Switch Button) -->
    <div class="auth-panel left d-flex flex-column text-center justify-content-center align-items-center p-4">
      <h2 id="panel-title" class="mb-3">Welcome Back!</h2>
      <p id="panel-text">To keep connected with us, login with your personal info.</p>
      <button id="panel-btn" class="auth-switch-btn mt-3" data-target="#register">Register</button>
    </div>

    <!-- RIGHT PANEL (Forms) -->
    <div class="auth-panel right p-4 flex-grow-1">
      <div class="tab-content w-100">

        <!-- LOGIN -->
        <div class="tab-pane fade show active" id="login" role="tabpanel">
          <h2 class="text-center mb-4">Login</h2>
          <?php echo CHtml::beginForm(); ?>
            <div class="auth-form">
              <?php echo CHtml::textField('LoginForm[email]', '', ['class' => 'form-control mb-3', 'placeholder' => 'Email']); ?>
              <?php echo CHtml::passwordField('LoginForm[password]', '', ['class' => 'form-control mb-3', 'placeholder' => 'Password']); ?>
              <?php echo CHtml::submitButton('Login', ['class' => 'btn btn-block text-white', 'style' => 'background-color: #D1001B;']); ?>
            </div>
          <?php echo CHtml::endForm(); ?>
        </div>

        <!-- REGISTER -->
        <div class="tab-pane fade" id="register" role="tabpanel">
          <h2 class="text-center mb-4">Create Account</h2>
          <?php echo CHtml::beginForm(['site/register'], 'post'); ?>
            <div class="auth-form">
              <?php echo CHtml::textField('Users[full_name]', '', ['class' => 'form-control mb-3', 'placeholder' => 'Name']); ?>
              <?php echo CHtml::textField('Users[email]', '', ['class' => 'form-control mb-3', 'placeholder' => 'Email']); ?>
              <?php echo CHtml::passwordField('Users[password_hash]', '', ['class' => 'form-control mb-3', 'placeholder' => 'Password']); ?>
              <?php echo CHtml::dropDownList('Users[role]', '', ['buyer' => 'Buyer', 'seller' => 'Seller'], ['class' => 'form-control mb-3']); ?>
              <?php echo CHtml::submitButton('Register', ['class' => 'btn btn-block text-white', 'style' => 'background-color: #D1001B;']); ?>
            </div>
          <?php echo CHtml::endForm(); ?>
          <div class="text-center mt-3">
            <button class="btn btn-link auth-switch-btn" data-target="#login">Already have an account? Login</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Panel Toggle Script -->
<script>
  $(document).ready(function () {
    function updatePanel(target) {
      if (target === '#register') {
        $('#panel-title').text('Welcome!');
        $('#panel-text').text('Already have an account? Login with your personal info.');
        $('#panel-btn').text('Login').attr('data-target', '#login');
      } else {
        $('#panel-title').text('Welcome Back!');
        $('#panel-text').text('To keep connected with us, login with your personal info.');
        $('#panel-btn').text('Register').attr('data-target', '#register');
      }
    }

    $('.auth-switch-btn').click(function (e) {
      e.preventDefault();
      const target = $(this).attr('data-target');
      $('.tab-pane').removeClass('show active');
      $(target).addClass('show active');
      updatePanel(target);
    });

    updatePanel('#login');
  });
</script>
