<?php
/* @var $this OrderItemsController */
/* @var $model OrderItems */

$this->breadcrumbs=array(
	'Order Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OrderItems', 'url'=>array('index')),
	array('label'=>'Create OrderItems', 'url'=>array('create')),
	array('label'=>'Update OrderItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OrderItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderItems', 'url'=>array('admin')),
);
?>

<h1>View OrderItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'order_id',
		'product_id',
		'quantity',
		'price',
	),
)); ?>
