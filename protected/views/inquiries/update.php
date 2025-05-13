<?php
/* @var $this InquiriesController */
/* @var $model Inquiries */

$this->breadcrumbs=array(
	'Inquiries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Inquiries', 'url'=>array('index')),
	array('label'=>'Create Inquiries', 'url'=>array('create')),
	array('label'=>'View Inquiries', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Inquiries', 'url'=>array('admin')),
);
?>

<h1>Update Inquiries <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>