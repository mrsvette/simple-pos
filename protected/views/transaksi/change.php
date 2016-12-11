<?php
$this->breadcrumbs=array(
	'Transaksi' => array('view'),
	'Ubah Data',
);

$this->menu=array(
	array(
		'label'=>Yii::t('global','List').' '.Yii::t('order','tagihan'), 
		'url'=>array('tagihan/view'),
		'visible'=>UserAccess::hasAccess('tagihan',Yii::app()->user->id,'read')
	),
	array(
		'label'=>Yii::t('global','List').' '.Yii::t('order','produk'), 
		'url'=>array('produk/view'),
		'visible'=>UserAccess::hasAccess('produk',Yii::app()->user->id,'read')
	),
	array(
		'label'=>Yii::t('global','List').' '.Yii::t('order','promosi'), 
		'url'=>array('promosi/view'),
		'visible'=>UserAccess::hasAccess('promosi',Yii::app()->user->id,'read')
	),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><i class="fa fa-briefcase"></i> Ubah Transaksi</h4>
	</div>
	<div class="panel-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model,'promocode'=>$promocode)); ?>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$('.page-container').toggleClass('hidden-sidebar');
	$('.sidebar').hide();
});
</script>
