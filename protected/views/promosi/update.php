<?php
/* @var $this PromosiController */
/* @var $model Promosi */

$this->breadcrumbs=array(
	'Promosis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Promosi', 'url'=>array('index')),
	array('label'=>'Create Promosi', 'url'=>array('create')),
	array('label'=>'View Promosi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Promosi', 'url'=>array('admin')),
);
?>

<h1>Update Promosi <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>