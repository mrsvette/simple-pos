<?php
/* @var $this PromosiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Promosis',
);

$this->menu=array(
	array('label'=>'Create Promosi', 'url'=>array('create')),
	array('label'=>'Manage Promosi', 'url'=>array('admin')),
);
?>

<h1>Promosis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
