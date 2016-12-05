<?php
/* @var $this ProdukDiskonController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Produk Diskons',
);

$this->menu=array(
	array('label'=>'Create ProdukDiskon', 'url'=>array('create')),
	array('label'=>'Manage ProdukDiskon', 'url'=>array('admin')),
);
?>

<h1>Produk Diskons</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
