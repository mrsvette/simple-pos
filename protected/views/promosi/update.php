<?php
/* @var $this PromosiController */
/* @var $model Promosi */

$this->breadcrumbs=array(
	'Promosi' => array('view'),
	'Update',
);

$this->menu=array(
	array('label'=>'Daftar Promosi', 'url'=>array('view')),
	array('label'=>'Tambah Promosi', 'url'=>array('create')),
);
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">Update Promosi</h4>
	</div>
	<div class="panel-body">
		<?php if(Yii::app()->user->hasFlash('update')): ?>
			<div class="alert alert-success mb10">
				<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
				<?php echo Yii::app()->user->getFlash('update'); ?>
			</div>
		<?php endif; ?>
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>
