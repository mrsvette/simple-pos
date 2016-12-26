<?php
$this->breadcrumbs = array(
	Yii::t('global','Dashboard'),
);

$this->menu = array(
	array('label'=>'Dashboard', 'url'=>array('index')),
	array('label'=>'Transaksi Baru', 'url'=>array('transaksi/create'),'visible'=>UserAccess::hasAccess('transaksi', Yii::app()->user->id, 'create_p')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="col-sm-12">
<div class="panel panel-default row">
	<div class="panel-heading">
		<h4 class="panel-title">
			Transaksi - 
			<?php echo Yii::t('global',date('l',strtotime($_GET['date'])));?>, 
			<?php echo date('d',strtotime($_GET['date']));?> 
			<?php echo Yii::t('global',date('F',strtotime($_GET['date'])));?> 
			<?php echo date('Y',strtotime($_GET['date']));?> 
		</h4>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$dataProvider,
					'itemsCssClass'=>'table table-striped mb30',
					'id'=>'order-grid',
					'afterAjaxUpdate' => 'reloadGrid',
					'columns'=>array(
						array(
							'value'=>'$this->grid->dataProvider->getPagination()->getOffset()+$row+1',
							'htmlOptions'=>array('style'=>'text-align:center;'),
						),
						array(
							'header'=>'Nama Menu',
							'type'=>'raw',
							'value'=>'$data->produk_rel->nama_produk'
						),
						array(
							'header'=>'Total Item',
							'type'=>'raw',
							'value'=>'Tagihan::getCountOrderItemDate($_GET[\'date\'],$data->id_produk)',
							'htmlOptions'=>array('style'=>'text-align:left;'),
						),
						array(
							'header'=>'Harga',
							'type'=>'raw',
							'value'=>'number_format($data->harga,0,\',\',\'.\')',
							'htmlOptions'=>array('style'=>'text-align:right;'),
						),
						array(
							'header'=>'Sub Total',
							'type'=>'raw',
							'value'=>'number_format(Tagihan::getTotalOrderDate($_GET[\'date\'],$data->id_produk),0,\',\',\'.\')',
							'htmlOptions'=>array('style'=>'text-align:right;'),
						),
					),
				)); ?>
		</div>
	</div>
	<div class="panel-footer">
		<?php echo CHtml::link('Simpan dalam format Excel',array('laporan/exportExcel','date'=>$_GET['date']),array('class'=>'btn btn-success','target'=>'_newtab'));?>
	</div>
</div>
</div>
<script type="text/javascript">
$(function(){
	var total="<?php echo $total_order;?>";
	$('#order-grid').find('tbody').append('<tr><td colspan="4">TOTAL</td><td style="text-align:right;"><b>'+total+'</b></td></tr>');
});
</script>
