<?php
/* @var $this PelangganController */
/* @var $model Pelanggan */

$this->breadcrumbs=array(
	'Pelanggan' => array('view'),
	'Kelola',
);

$this->menu=array(
	array('label'=>'Daftar Pelanggan', 'url'=>array('view')),
	array('label'=>'Tambah Pelanggan', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pelanggan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">Kelola Pelanggan</h4>
	</div>
	<div class="panel-body">
		<?php echo CHtml::link(Yii::t('global','Advanced Search'),'#',array('class'=>'search-button pull-right btn btn-default-alt')); ?>
		<div class="search-form" style="display:none">
			<?php $this->renderPartial('_search',array(
				'model'=>$model,
			)); ?>
		</div><!-- search-form -->

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'pelanggan-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'afterAjaxUpdate' => 'reloadGrid',
			'itemsCssClass'=>'table table-striped mb30',
			'columns'=>array(
				'id',
				'nama_pelanggan',
				'email_pelanggan',
				'telepon_pelanggan',
				'alamat_pelanggan',
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
							'url'=>'Yii::app()->createUrl("/pelanggan/update",array(\'id\'=>$data->id))',
							'options'=>array('title'=>'Update'),
							'visible'=>'true',
						),
						'delete'=>array(
							'label'=>'<i class="fa fa-trash-o"></i>',
							'imageUrl'=>false,
							'url'=>'Yii::app()->createUrl("/pelanggan/delete",array(\'id\'=>$data->id))',
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
