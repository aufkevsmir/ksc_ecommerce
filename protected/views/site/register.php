<h2 class="text-xl font-semibold mb-4">Register an Account</h2>

<?php if (Yii::app()->user->hasFlash('success')): ?>
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
    <?php echo Yii::app()->user->getFlash('success'); ?>
  </div>
<?php endif; ?>

<div class="form">
<?php $form = $this->beginWidget('CActiveForm', ['id' => 'register-form']); ?>

  <div class="mb-4">
    <?php echo $form->labelEx($model, 'full_name'); ?>
    <?php echo $form->textField($model, 'full_name', ['class' => 'border p-2 rounded w-full']); ?>
    <?php echo $form->error($model, 'full_name'); ?>
  </div>

  <div class="mb-4">
    <?php echo $form->labelEx($model, 'email'); ?>
    <?php echo $form->textField($model, 'email', ['class' => 'border p-2 rounded w-full']); ?>
    <?php echo $form->error($model, 'email'); ?>
  </div>

  <div class="mb-4">
    <?php echo $form->labelEx($model, 'Password'); ?>
    <?php echo $form->passwordField($model, 'password_hash', ['class' => 'border p-2 rounded w-full']); ?>
    <?php echo $form->error($model, 'password_hash'); ?>
  </div>

  <div class="mb-4">
    <?php echo $form->labelEx($model, 'role'); ?>
    <?php echo $form->dropDownList($model, 'role', ['buyer' => 'Buyer', 'seller' => 'Seller'], ['prompt' => 'Select Role', 'class' => 'border p-2 rounded w-full']); ?>
    <?php echo $form->error($model, 'role'); ?>
  </div>

  <div>
    <?php echo CHtml::submitButton('Register', ['class' => 'bg-blue-500 text-white px-4 py-2 rounded']); ?>
  </div>

<?php $this->endWidget(); ?>
</div>
