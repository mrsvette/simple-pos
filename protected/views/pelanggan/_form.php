<?php
/* @var $this PelangganController */
/* @var $model Pelanggan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pelanggan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_pelanggan'); ?>
		<?php echo $form->textField($model,'nama_pelanggan',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'nama_pelanggan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_pelanggan'); ?>
		<?php echo $form->textField($model,'email_pelanggan',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email_pelanggan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telepon_pelanggan'); ?>
		<?php echo $form->textField($model,'telepon_pelanggan',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'telepon_pelanggan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alamat_pelanggan'); ?>
		<?php echo $form->textArea($model,'alamat_pelanggan',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'alamat_pelanggan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal_input'); ?>
		<?php echo $form->textField($model,'tanggal_input'); ?>
		<?php echo $form->error($model,'tanggal_input'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_input'); ?>
		<?php echo $form->textField($model,'user_input'); ?>
		<?php echo $form->error($model,'user_input'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->