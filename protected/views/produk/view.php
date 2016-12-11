<?php
/* @var $this ProdukController */
/* @var $model Produk */

$this->breadcrumbs=array(
	'Produk' => array('view'),
	'Kelola',
);

$this->menu=array(
	array('label'=>'Daftar Produk', 'url'=>array('view')),
	array('label'=>'Tambah Produk', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#produk-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">Kelola Produk</h4>
	</div>
	<div class="panel-body">
		<?php echo CHtml::link(Yii::t('global','Advanced Search'),'#',array('class'=>'search-button pull-right btn btn-default-alt')); ?>
		<div class="search-form" style="display:none">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'produk-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'afterAjaxUpdate' => 'reloadGrid',
			'itemsCssClass'=>'table table-striped mb30',
			'columns'=>array(
				'id',
				'nama_produk',
				array(
					'name'=>'jenis_produk',
					'type'=>'raw',
					'value'=>'$data->jenis_produk',
					'filter'=>Produk::getListType()
				),
				array(
					'name'=>'harga_produk',
					'type'=>'raw',
					'value'=>'$data->harga_produk',
					'htmlOptions'=>array('style'=>'text-align:right;'),
				),
				'tanggal_input',
				/*
				'user_input',
				*/
				array(
					'class'=>'CButtonColumn',
					'template'=>'{update}{delete}',
					'buttons'=>array
					(
						'update'=>array(
							'label'=>'<i class="fa fa-pencil"></i>',
							'imageUrl'=>false,
							'url'=>'Yii::app()->createUrl("/produk/update",array(\'id\'=>$data->id))',
							'options'=>array('title'=>'Update'),
							'visible'=>'true',
						),
						'delete'=>array(
							'label'=>'<i class="fa fa-trash-o"></i>',
							'imageUrl'=>false,
							'url'=>'Yii::app()->createUrl("/produk/delete",array(\'id\'=>$data->id))',
							'options'=>array('title'=>'Delete'),
							'visible'=>'true',
						),
					),
					'htmlOptions'=>array('style'=>'width:10%;','class'=>'table-action'),
				),
			),
		)); ?>
	</div>
</div>
