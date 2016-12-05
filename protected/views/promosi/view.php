<?php
/* @var $this PromosiController */
/* @var $model Promosi */

$this->breadcrumbs=array(
	'Promosis'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Promosi', 'url'=>array('index')),
	array('label'=>'Create Promosi', 'url'=>array('create')),
	array('label'=>'Update Promosi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Promosi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Promosi', 'url'=>array('admin')),
);
?>

<h1>View Promosi #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kode_promosi',
		'deskripsi',
		'jenis_promosi',
		'nilai_promosi',
		'maksimal_digunakan',
		'telah_digunakan',
		'status_promosi',
		'produk_yang_terdiskon',
		'tanggal_mulai_promosi',
		'tanggal_berakhir_promosi',
		'tanggal_input',
		'user_input',
	),
)); ?>
