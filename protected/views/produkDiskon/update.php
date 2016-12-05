<?php
/* @var $this ProdukDiskonController */
/* @var $model ProdukDiskon */

$this->breadcrumbs=array(
	'Produk Diskons'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProdukDiskon', 'url'=>array('index')),
	array('label'=>'Create ProdukDiskon', 'url'=>array('create')),
	array('label'=>'View ProdukDiskon', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProdukDiskon', 'url'=>array('admin')),
);
?>

<h1>Update ProdukDiskon <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>