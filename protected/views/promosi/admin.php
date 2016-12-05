<?php
/* @var $this PromosiController */
/* @var $model Promosi */

$this->breadcrumbs=array(
	'Promosis'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Promosi', 'url'=>array('index')),
	array('label'=>'Create Promosi', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#promosi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Promosis</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'promosi-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'kode_promosi',
		'deskripsi',
		'jenis_promosi',
		'nilai_promosi',
		'maksimal_digunakan',
		/*
		'telah_digunakan',
		'status_promosi',
		'produk_yang_terdiskon',
		'tanggal_mulai_promosi',
		'tanggal_berakhir_promosi',
		'tanggal_input',
		'user_input',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
