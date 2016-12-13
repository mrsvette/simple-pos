<?php
$this->breadcrumbs=array(
	'Tagihan'=>array('view'),
	'Kelola',
);

$this->menu=array(
	array(
		'label'=>'Tagihan', 
		'url'=>array('view'),
	),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('all-grid', {
		data: $(this).serialize()
	});
	$.fn.yiiGridView.update('paid-grid', {
		data: $(this).serialize()
	});
	$.fn.yiiGridView.update('unpaid-grid', {
		data: $(this).serialize()
	});
	$.fn.yiiGridView.update('refund-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<ul class="row stats">
	<li class="col-xs-3">
		<a class="btn btn-default" href="#paid-invoice"><?php echo $paidProvider->totalItemCount;?></a>
		<span>Tagihan Terbayar</span>
	</li>
	<li class="col-xs-3">
		<a class="btn btn-default" href="#unpaid-invoice"><?php echo $unpaidProvider->totalItemCount;?></a>
		<span>Tagihan Belum terbayar</span>
	</li>
	<li class="col-xs-3">
		<a class="btn btn-default" href="#refund-invoice"><?php echo $unpaidProvider->totalItemCount;?></a>
		<span><?php echo Yii::t('order','Refund Invoice');?></span>
	</li>
	<li class="col-xs-3">
		<a class="btn btn-default" href="#all-invoice"><?php echo $dataProvider->totalItemCount;?></a>
		<span>Semua Tagihan</span>
	</li>
</ul>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo Yii::t('global','Manage');?> <?php echo Yii::t('order','Invoices');?></h4>
	</div>
	<div class="panel-body">
		<?php echo CHtml::link(Yii::t('global','Advanced Search'),'#',array('class'=>'search-button pull-right btn btn-default-alt')); ?>
		<ul class="nav nav-tabs">
			<li class="">
				<a data-toggle="tab" href="#paid-invoice">
					<strong><?php echo Yii::t('order','Paid Invoice');?></strong> <span class="badge badge-warning"><?php echo $paidProvider->totalItemCount;?></span>
				</a>
			</li>
			<li class="">
				<a data-toggle="tab" href="#unpaid-invoice">
					<strong><?php echo Yii::t('order','Unpaid Invoice');?></strong> <span class="badge badge-warning"><?php echo $unpaidProvider->totalItemCount;?></span>
				</a>
			</li>
			<li class="">
				<a data-toggle="tab" href="#refund-invoice">
					<strong><?php echo Yii::t('order','Refund Invoice');?></strong> <span class="badge badge-warning"><?php echo $refundProvider->totalItemCount;?></span>
				</a>
			</li>
			<li class="active">
				<a data-toggle="tab" href="#all-invoice">
					<strong><?php echo Yii::t('order','All Invoice');?></strong> <span class="badge badge-warning"><?php echo $dataProvider->totalItemCount;?></span>
				</a>
			</li>
		</ul>
		<div class="search-form  col-sm-12 mar_top2" style="display:none">
		<?php $this->renderPartial('_search',array(
			'model'=>$dataProvider->model,
		)); ?>
		</div><!-- search-form -->
		<div class="tab-content pill-content">
			<div id="paid-invoice" class="tab-pane">
				<div class="table-responsive">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$paidProvider,
					'itemsCssClass'=>'table table-striped mb30',
					'id'=>'paid-grid',
					'afterAjaxUpdate' => 'reloadGrid',
					'columns'=>array(
						array(
							'value'=>'$this->grid->dataProvider->getPagination()->getOffset()+$row+1',
						),
						/*array(
							'name'=>'id_pelanggan',
							'type'=>'raw',
							'value'=>'$data->pelanggan_rel->nama_pelanggan'
						),*/
						array(
							'name'=>'nomor_tagihan',
							'type'=>'raw',
							'value'=>'$data->nomor_tagihan'
						),
						array(
							'name'=>'status_tagihan',
							'type'=>'raw',
							'value'=>'$data->status_tagihan'
						),
						array(
							'header'=>'total_tagihan',
							'type'=>'raw',
							'value'=>'number_format($data->total_tagihan,0,\',\',\'.\')'
						),
						array(
							'name'=>'tanggal_input',
							'type'=>'raw',
							'value'=>'date("d-m-Y H:i",strtotime($data->tanggal_input))'
						),
						array(
							'class'=>'CButtonColumn',
							'template'=>'{update}{delete}',
							'buttons'=>array
								(
									'update'=>array(
											'label'=>'<i class="fa fa-pencil"></i>',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createUrl("/tagihan/update",array(\'id\'=>$data->id))',
											'options'=>array('title'=>'Update','id'=>'update-list'),
											'visible'=>'true',
										),
									'delete'=>array(
											'label'=>'<i class="fa fa-trash-o"></i>',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createUrl("/tagihan/delete",array(\'id\'=>$data->id))',
											'options'=>array('title'=>'Delete','id'=>'delete-list'),
											'visible'=>'true',
										),
								),
							'htmlOptions'=>array('style'=>'width:10%;','class'=>'table-action'),
						),
					),
				)); ?>
				</div>
			</div>
			<div id="unpaid-invoice" class="tab-pane">
				<div class="table-responsive">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$unpaidProvider,
					'itemsCssClass'=>'table table-striped mb30',
					'id'=>'unpaid-grid',
					'afterAjaxUpdate' => 'reloadGrid',
					'columns'=>array(
                        array(
                            'value'=>'$this->grid->dataProvider->getPagination()->getOffset()+$row+1',
                        ),
                        /*array(
                            'name'=>'id_pelanggan',
                            'type'=>'raw',
                            'value'=>'$data->pelanggan_rel->nama_pelanggan'
                        ),*/
                        array(
                            'name'=>'nomor_tagihan',
                            'type'=>'raw',
                            'value'=>'$data->nomor_tagihan'
                        ),
                        array(
                            'name'=>'status_tagihan',
                            'type'=>'raw',
                            'value'=>'$data->status_tagihan'
                        ),
                        array(
                            'header'=>'total_tagihan',
                            'type'=>'raw',
                            'value'=>'number_format($data->total_tagihan,0,\',\',\'.\')'
                        ),
                        array(
                            'name'=>'tanggal_input',
                            'type'=>'raw',
                            'value'=>'date("d-m-Y H:i",strtotime($data->tanggal_input))'
                        ),
						array(
							'class'=>'CButtonColumn',
							'template'=>'{update}{delete}',
							'buttons'=>array
								(
									'update'=>array(
											'label'=>'<i class="fa fa-pencil"></i>',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createUrl("/tagihan/update",array(\'id\'=>$data->id))',
											'options'=>array('title'=>'Update','id'=>'update-list'),
											'visible'=>'true',
										),
									'delete'=>array(
											'label'=>'<i class="fa fa-trash-o"></i>',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createUrl("/tagihan/delete",array(\'id\'=>$data->id))',
											'options'=>array('title'=>'Delete','id'=>'delete-list'),
											'visible'=>'true',
										),
								),
							'htmlOptions'=>array('style'=>'width:10%;','class'=>'table-action'),
						),
					),
				)); ?>
				</div>
			</div>
			<div id="refund-invoice" class="tab-pane">
				<div class="table-responsive">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$refundProvider,
					'itemsCssClass'=>'table table-striped mb30',
					'id'=>'refund-grid',
					'afterAjaxUpdate' => 'reloadGrid',
					'columns'=>array(
                        array(
                            'value'=>'$this->grid->dataProvider->getPagination()->getOffset()+$row+1',
                        ),
                        /*array(
                            'name'=>'id_pelanggan',
                            'type'=>'raw',
                            'value'=>'$data->pelanggan_rel->nama_pelanggan'
                        ),*/
                        array(
                            'name'=>'nomor_tagihan',
                            'type'=>'raw',
                            'value'=>'$data->nomor_tagihan'
                        ),
                        array(
                            'name'=>'status_tagihan',
                            'type'=>'raw',
                            'value'=>'$data->status_tagihan'
                        ),
                        array(
                            'header'=>'total_tagihan',
                            'type'=>'raw',
                            'value'=>'number_format($data->total_tagihan,0,\',\',\'.\')'
                        ),
                        array(
                            'name'=>'tanggal_input',
                            'type'=>'raw',
                            'value'=>'date("d-m-Y H:i",strtotime($data->tanggal_input))'
                        ),
						array(
							'class'=>'CButtonColumn',
							'template'=>'{update}{delete}',
							'buttons'=>array
								(
									'update'=>array(
											'label'=>'<i class="fa fa-pencil"></i>',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createUrl("/tagihan/update",array(\'id\'=>$data->id))',
											'options'=>array('title'=>'Update','id'=>'update-list'),
											'visible'=>'true',
										),
									'delete'=>array(
											'label'=>'<i class="fa fa-trash-o"></i>',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createUrl("/tagihan/delete",array(\'id\'=>$data->id))',
											'options'=>array('title'=>'Delete','id'=>'delete-list'),
											'visible'=>'true',
										),
								),
							'htmlOptions'=>array('style'=>'width:10%;','class'=>'table-action'),
						),
					),
				)); ?>
				</div>
			</div>
			<div id="all-invoice" class="tab-pane active">
				<div class="table-responsive">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$dataProvider,
					'itemsCssClass'=>'table table-striped mb30',
					'id'=>'all-grid',
					'afterAjaxUpdate' => 'reloadGrid',
					'columns'=>array(
						array(
							'value'=>'$this->grid->dataProvider->getPagination()->getOffset()+$row+1',
						),
						/*array(
                            'name'=>'id_pelanggan',
                            'type'=>'raw',
                            'value'=>'$data->pelanggan_rel->nama_pelanggan'
                        ),*/
						array(
							'name'=>'nomor_tagihan',
							'type'=>'raw',
							'value'=>'$data->nomor_tagihan'
						),
						array(
							'name'=>'status_tagihan',
							'type'=>'raw',
							'value'=>'$data->status_tagihan'
						),
						array(
							'header'=>'total_tagihan',
							'type'=>'raw',
							'value'=>'number_format($data->total_tagihan,0,\',\',\'.\')'
						),
						array(
							'name'=>'tanggal_input',
							'type'=>'raw',
							'value'=>'date("d-m-Y H:i",strtotime($data->tanggal_input))'
						),
						array(
							'class'=>'CButtonColumn',
							'template'=>'{update}{delete}',
							'buttons'=>array
								(
									'update'=>array(
											'label'=>'<i class="fa fa-pencil"></i>',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createUrl("/tagihan/update",array(\'id\'=>$data->id))',
											'options'=>array('title'=>'Update','id'=>'update-list'),
											'visible'=>'true',
										),
									'delete'=>array(
											'label'=>'<i class="fa fa-trash-o"></i>',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createUrl("/tagihan/delete",array(\'id\'=>$data->id))',
											'options'=>array('title'=>'Delete','id'=>'delete-list'),
											'visible'=>'true',
										),
								),
							'htmlOptions'=>array('style'=>'width:10%;','class'=>'table-action'),
						),
					),
				)); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('.stats').find('.btn').click(function(){
	$('.nav-tabs').find('a[href="'+$(this).attr('href')+'"]').trigger('click');
	return false;
});
</script>
