<?php
/* @var $this ProdukDiskonController */
/* @var $model ProdukDiskon */

$this->breadcrumbs=array(
	'Produk Diskons'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProdukDiskon', 'url'=>array('index')),
	array('label'=>'Create ProdukDiskon', 'url'=>array('create')),
	array('label'=>'Update ProdukDiskon', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProdukDiskon', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProdukDiskon', 'url'=>array('admin')),
);
?>

<h1>View ProdukDiskon #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_produk',
		'jumlah_produk',
		'harga_produk',
		'tanggal_mulai_diskon',
		'tanggal_berakhir_diskon',
		'tanggal_input',
		'user_input',
	),
)); ?>
