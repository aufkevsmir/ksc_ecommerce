<?php
/* @var $this OrderItemsController */
/* @var $model OrderItems */

$this->breadcrumbs=array(
	'Order Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderItems', 'url'=>array('index')),
	array('label'=>'Create OrderItems', 'url'=>array('create')),
	array('label'=>'View OrderItems', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OrderItems', 'url'=>array('admin')),
);
?>

<h1>Update OrderItems <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>