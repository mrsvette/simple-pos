<?php
$this->breadcrumbs = array(
	'Users' => array('view'),
	'Update' => array('update','id'=>$model->id),
	$model->id,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('view'),'visible'=>UserAccess::ruleAccess('read_p')),
	array('label'=>'Create User', 'url'=>array('create'),'visible'=>UserAccess::ruleAccess('create_p')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo Yii::t('global','Update');?> User</h4>
	</div>
	<div class="panel-body">
		<?php if(Yii::app()->user->hasFlash('update')): ?>
			<div class="alert alert-success mb10">
				<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
				<?php echo Yii::app()->user->getFlash('update'); ?>
			</div>
		<?php endif; ?>
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>
