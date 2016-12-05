<?php
/* @var $this ProdukDiskonController */
/* @var $model ProdukDiskon */

$this->breadcrumbs=array(
	'Produk Diskons'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProdukDiskon', 'url'=>array('index')),
	array('label'=>'Manage ProdukDiskon', 'url'=>array('admin')),
);
?>

<h1>Create ProdukDiskon</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>