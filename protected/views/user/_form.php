<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-warning alert-block alert-dismissable fade in')); ?>

	<div class="form-group col-md-4">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>30,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group col-md-4">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', $model->listStatus); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<?php if($model->isNewRecord): ?>
	<div class="form-group col-md-4">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<?php else: ?>
	<div class="col-md-12">
		<div class="row">
			<div class="form-group col-md-4">
				<?php echo $form->labelEx($model,'password_baru'); ?>
				<?php echo $form->passwordField($model,'password_baru',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model,'password_baru'); ?>
			</div>
			<div class="form-group col-md-4">
				<?php echo $form->labelEx($model,'password_baru_diulang'); ?>
				<?php echo $form->passwordField($model,'password_baru_diulang',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model,'password_baru_diulang'); ?>
			</div>
		</div>
	</div>
	<?php endif;?>

	<div class="form-group col-md-12">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', array('style'=>'min-width:100px;')); ?>
	</div>

<?php $this->endWidget(); ?>
