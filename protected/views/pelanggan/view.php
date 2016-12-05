<?php
/* @var $this PelangganController */
/* @var $model Pelanggan */

$this->breadcrumbs=array(
	'Pelanggans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pelanggan', 'url'=>array('index')),
	array('label'=>'Create Pelanggan', 'url'=>array('create')),
	array('label'=>'Update Pelanggan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pelanggan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pelanggan', 'url'=>array('admin')),
);
?>

<h1>View Pelanggan #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama_pelanggan',
		'email_pelanggan',
		'telepon_pelanggan',
		'alamat_pelanggan',
		'tanggal_input',
		'user_input',
	),
)); ?>
