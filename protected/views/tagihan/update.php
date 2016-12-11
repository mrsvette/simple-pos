<?php
$this->breadcrumbs=array(
	'Tagihan' => array('view'),
	$model->id => array('update','id'=>$model->id),
	'Ubah',
);

$this->menu = array(
	array('label'=>'Daftar Tagihan', 'url'=>array('view')),
);
?>
<div class="row">
	<div class="col-sm-8">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">Tagihan #<?php echo $model->nomor_tagihan; ?></h4>
		</div>
		<div class="panel-body">
			<div class="tabbable">
			<ul class="nav nav-pills nav-justified">
				<li class="active">
					<a data-toggle="tab" href="#detail-invoice">
						<strong>Detail Tagihan</strong>
					</a>
				</li>
				<li class="">
					<a data-toggle="tab" href="#update-invoice">
						<strong>Kelola Tagihan</strong>
					</a>
				</li>
			</ul>
			<div class="tab-content pill-content">
				<div id="detail-invoice" class="tab-pane active">
					<div class="row">
					<div class="table-responsive col-sm-8 no-padding">
					<?php
					$this->widget('zii.widgets.CDetailView', array(
						'data'=>$model,
						'id'=>'detail-invoice',
						'htmlOptions'=>array('class'=>'table table-striped mb30'),
						'attributes'=>array(
							array(
								'name'=>'nomor_tagihan',
								'type'=>'raw',
								'value'=>$model->nomor_tagihan,
							),
							array(
								'name'=>'Total',
								'type'=>'raw',
								'value'=>'Rp. '.number_format($model->total_tagihan,2,',','.'),
							),
							array(
								'name'=>'status_tagihan',
								'type'=>'raw',
								'value'=>$model->status_tagihan,
							),
							array(
								'name'=>'Pelanggan',
								'type'=>'raw',
								'value'=>$model->customer_rel->nama_pelanggan,
								'visible'=>$model->customer_rel>0,
							),
							array(
								'name'=>'Tanggal Input',
								'type'=>'raw',
								'value'=>date("d-m-Y H:i",strtotime($model->tanggal_input)),
							),
							array(
								'name'=>'Tanggal Pembayaran',
								'type'=>'raw',
								'value'=>date("d-m-Y H:i",strtotime($model->tanggal_pembayaran)),
								'visible'=>($model->status_tagihan == Tagihan::STATUS_PAID),
							),
						),
					));
					?>
					</div>
					<div class="col-sm-4">
						<div class="dropdown widget clearfix">
							<ul class="dropdown-menu" style="display: block; position: static;" role="menu">
								<?php if($model->status_tagihan != Tagihan::STATUS_REFUND):?>
								<li>
									<a id="btn-refund" href="<?php echo Yii::app()->createUrl('/tagihan/refund',array('id'=>$model->id));?>">
										<i class="fa fa-rotate-right"></i>
										Refund
									</a>
								</li>
								<?php endif;?>
								<li>
									<a id="btn-print-preview" href="<?php echo Yii::app()->createUrl('/tagihan/printPreview',array('id'=>$model->id));?>">
										<i class="fa fa-print"></i>
										Print Preview
									</a>
								</li>
								<li>
									<a id="btn-delete" href="<?php echo Yii::app()->createUrl('/tagihan/delete',array('id'=>$model->id,'ajax'=>true));?>">
										<i class="fa fa-trash-o"></i>
										Delete
									</a>
								</li>
								<li>
									<a id="btn-change" href="<?php echo Yii::app()->createUrl('/transaksi/change',array('id'=>$model->id));?>">
										<i class="fa fa-pencil"></i>
										Change Invoice
									</a>
								</li>
							</ul>
						</div>
					</div>
					</div>
				</div>
				<div id="update-invoice" class="tab-pane">
					<?php if(Yii::app()->user->hasFlash('update')): ?>
					<div class="alert alert-success">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
						<?php echo Yii::app()->user->getFlash('update'); ?>
					</div>
					<?php endif; ?>

					<?php $form=$this->beginWidget('CActiveForm'); ?>
					<div class="form-group col-sm-4">
						<?php echo $form->label($model,'customer_id',array('class'=>'control-label')); ?>
						<?php $this->widget('ext.bootstrap-select.TbSelect',array(
								   'model' => $model,
								   'attribute' => 'id_pelanggan',
								   'data' => Pelanggan::list_items(),
								   'htmlOptions' => array(
										//'multiple' => true,
										'data-live-search'=>true,
										'class'=>'form-control no-margin',
								   ),
						)); ?>
					</div>

					<div class="form-group col-sm-4">
						<?php echo $form->label($model,'status_tagihan',array('class'=>'control-label')); ?>
						<?php echo $form->dropDownList($model,'status_tagihan',Tagihan::getListStatus(),array('class'=>'form-control')); ?>
					</div>

					<div class="form-group col-sm-4">
						<?php echo $form->label($model,'date_entry',array('class'=>'control-label')); ?>
						<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'model'=>$model, //Model object
							'attribute'=>'tanggal_input', //attribute name
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>'yy-mm-dd',
								'changeMonth' => 'true',
								'changeYear'=>'true',
								'constrainInput' => 'false'
							),
							'htmlOptions'=>array(
								'class'=>'form-control',
								'value'=>date('Y-m-d',strtotime($model->tanggal_input)),
							),
						));
						?>
					</div>

					<div class="form-group col-sm-4">
						<?php echo $form->label($model,'tanggal_pembayaran',array('class'=>'control-label')); ?>
						<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'model'=>$model, //Model object
							'attribute'=>'paid_at', //attribute name
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>'yy-mm-dd',
								'changeMonth' => 'true',
								'changeYear'=>'true',
								'constrainInput' => 'false'
							),
							'htmlOptions'=>array(
								'class'=>'form-control',
								'value'=>date('Y-m-d',strtotime($model->tanggal_pembayaran)),
							),
						));
						?>
					</div>

					<div class="form-group col-sm-4">
						<?php echo $form->label($model,'nomor_tagihan',array('class'=>'control-label')); ?>
						<?php echo $form->textField($model,'nomor_tagihan',array('class'=>'form-control')); ?>
					</div>

					<div class="form-group col-sm-12">
						<?php echo $form->label($model,'catatan',array('class'=>'control-label')); ?>
						<?php echo $form->textArea($model,'catatan',array('class'=>'form-control')); ?>
					</div>

					<div class="form-group col-sm-12">Items Data:</div>
					<div class="table-responsive">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$itemsProvider,
					'itemsCssClass'=>'table table-striped mb30',
					'id'=>'items-grid',
					'columns'=>array(
						array(
							'value'=>'$this->grid->dataProvider->getPagination()->getOffset()+$row+1',
						),
						array(
							'name'=>'produk_rel.nama_produk',
							'type'=>'raw',
							'value'=>'$data->produk_rel->nama_produk'
						),
						array(
							'name'=>'jumlah',
							'type'=>'raw',
							'value'=>'$data->jumlah'
						),
						array(
							'name'=>'harga',
							'type'=>'raw',
							'value'=>'$data->harga'
						),
						array(
							'class'=>'CButtonColumn',
							'template'=>'{delete}',
							'buttons'=>array
								(
									'delete'=>array(
											'label'=>'<i class="fa fa-trash-o"></i>',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createUrl("/tagihan/deleteItem",array(\'id\'=>$data->id))',
											'options'=>array('title'=>'Delete','id'=>'delete-list'),
											'visible'=>'true',
										),
								),
							'htmlOptions'=>array('style'=>'width:10%;','class'=>'table-action'),
						),
					),
				)); ?>
				</div>

					<div class="form-group col-sm-12">
						<?php echo CHtml::submitButton(Yii::t('global','Update'),array('class'=>'btn btn-success','style'=>'min-width:100px;')); ?>
					</div>

					<?php $this->endWidget(); ?>
				</div>
			</div><!-- tab-content -->
			</div><!-- tabbable -->
		</div>
	</div>
	</div>
	<div class="col-sm-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title"><?php echo Yii::t('global','Invoice items');?></h4>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
					<?php if($model->items_count>0):?>
						<table class="table table-striped mb10">
							<thead>
								<tr>
									<th>&nbsp;</th>
									<th><?php echo Yii::t('order','Title');?></th>
									<th><?php echo Yii::t('order','Quantity');?></th>
									<th><?php echo Yii::t('order','Price');?></th>
								</tr>
							</thead>
							<tbody>
						<?php $no=1;?>
						<?php foreach($model->items_rel as $item):?>
							<tr>
								<td><?php echo $no;?></td>	
								<td><?php echo CHtml::link($item->produk_rel->nama_produk,array('/produk/update','id'=>$item->id_produk));?></td>
								<td><?php echo $item->jumlah;?></td>
								<td><?php echo number_format($item->harga*$item->jumlah,0,',','.');?></td>
							</tr>
						<?php $no++;?>
						<?php endforeach;?>
							<tr>
								<td colspan="3"><b>TOTAL</b></td>
								<td><b><?php echo number_format($model->total_tagihan,0,',','.');?></b></td>
							</tr>
							</tbody>
						</table>
					<?php endif;?>
			</div>
		</div>
	</div>
	</div>
</div>
<button class="btn btn-primary btn-lg hidden" data-target="#myModal" data-toggle="modal" id="launch-modal"> Launch Modal </button>
<div id="myModal" class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
				<h4 id="myModalLabel" class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body has-padding" id="div-for-preview"> Content goes here... </div>
			<div class="modal-footer">
			<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
			<button class="btn btn-primary" id="btn-print" type="button">Print</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('#btn-refund').click(function(){
	var $this=$(this);
	if(confirm('Anda yakin ingin melakukan refund untuk invoice ini ?')){
		$.ajax({
			'beforeSend': function() { Loading.show(); },
			'complete': function() { Loading.hide(); },
			'url':$this.attr('href'),
			'type':'post',
			'dataType':'json',
			'success':function(data){
				if(data.status=='success'){
					window.location.reload(true);
				}
			}
		});
	}
	return false;
});
$('#btn-delete').click(function(){
	var $this=$(this);
	if(confirm('Anda yakin ingin menghapus invoice ini ?')){
		$.ajax({
			'beforeSend': function() { Loading.show(); },
			'complete': function() { Loading.hide(); },
			'url':$this.attr('href'),
			'type':'post',
			'dataType':'json',
			'success':function(data){
				window.location.href="<?php echo Yii::app()->createUrl('/'.Yii::app()->controller->module->id.'/tagihan/view');?>";
			}
		});
	}
	return false;
});
$('#btn-print-preview').click(function(){
	var $this=$(this);
	$.ajax({
		'beforeSend': function() { Loading.show(); },
		'complete': function() { Loading.hide(); },
		'url':$this.attr('href'),
		'type':'post',
		'dataType':'json',
		'success':function(data){
			if(data.status=='success'){
				$('.modal-content .modal-header').hide();
				$('.modal-content #div-for-preview').html(data.div);
				$('#launch-modal').trigger('click');
			}
		}
	});
	return false;
});
$('a[id="add-list"]').click(function(){
	var $this=$(this);
	$.ajax({
		'beforeSend': function() { Loading.show(); },
		'complete': function() { Loading.hide(); },
		'url':$this.attr('href'),
		'type':'post',
		'dataType':'json',
		'success':function(data){
			if(data.status=='success'){
				$('#items-grid').find('tbody').append(data.div);
			}
		}
	});
	return false;
});
</script>
