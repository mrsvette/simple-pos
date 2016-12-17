<?php
/* @var $this ProdukController */
/* @var $model Produk */

$this->breadcrumbs=array(
	'Produk' => array('view'),
	'Tambah',
);

$this->menu=array(
	array('label'=>'Daftar Produk', 'url'=>array('view')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">Tambah Produk</h4>
	</div>
	<div class="panel-body">
		<?php if(Yii::app()->user->hasFlash('create')): ?>
			<div class="alert alert-success mb10">
				<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
				<?php echo Yii::app()->user->getFlash('create'); ?>
			</div>
		<?php endif; ?>
		<?php echo $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2)); ?>
	</div>
</div>