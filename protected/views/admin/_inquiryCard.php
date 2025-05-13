<?php /** @var Inquiries $data */ ?>

<div class="card shadow-sm mb-4">
  <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
    <div>
      <strong>Product:</strong> <?php echo CHtml::encode($data->product->name); ?><br>
      <small class="text-muted">Buyer: <?php echo CHtml::encode($data->buyer->full_name); ?></small>
    </div>
    <small class="text-muted"><?php echo date('M j, Y g:i A', strtotime($data->created_at)); ?></small>
  </div>

  <div class="card-body">
    <p class="mb-2"><strong>Message:</strong><br><?php echo nl2br(CHtml::encode($data->message)); ?></p>

    <p class="mb-2"><strong>Status:</strong>
      <span class="badge badge-<?php echo $data->status === 'responded' ? 'success' : 'secondary'; ?>">
        <?php echo ucfirst($data->status); ?>
      </span>
    </p>

    <?php if ($data->reply_message): ?>
      <div class="bg-light p-3 rounded">
        <p class="mb-1"><strong>Reply:</strong></p>
        <p class="mb-0"><?php echo nl2br(CHtml::encode($data->reply_message)); ?></p>
      </div>
    <?php endif; ?>
  </div>
</div>
