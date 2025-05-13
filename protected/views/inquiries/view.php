<?php
/* @var $this InquiriesController */
/* @var $model Inquiries */

$this->breadcrumbs=array(
	'Inquiries'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Inquiries', 'url'=>array('index')),
	array('label'=>'Create Inquiries', 'url'=>array('create')),
	array('label'=>'Update Inquiries', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Inquiries', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Inquiries', 'url'=>array('admin')),
);
?>

<h1>View Inquiries #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'buyer_id',
		'product_id',
		'message',
		'status',
		'created_at',
	),
)); ?>
