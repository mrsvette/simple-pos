<?php
/* @var $this ProdukController */
/* @var $model Produk */

$this->breadcrumbs=array(
	'Produks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Produk', 'url'=>array('index')),
	array('label'=>'Create Produk', 'url'=>array('create')),
	array('label'=>'Update Produk', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Produk', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Produk', 'url'=>array('admin')),
);
?>

<h1>View Produk #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama_produk',
		'deskripsi_produk',
		'jenis_produk',
		'harga_produk',
		'tanggal_input',
		'user_input',
	),
)); ?>
