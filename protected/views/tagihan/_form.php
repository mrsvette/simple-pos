<?php
/* @var $this TagihanController */
/* @var $model Tagihan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tagihan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nomor_tagihan'); ?>
		<?php echo $form->textField($model,'nomor_tagihan',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'nomor_tagihan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pelanggan'); ?>
		<?php echo $form->textField($model,'id_pelanggan'); ?>
		<?php echo $form->error($model,'id_pelanggan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_tagihan'); ?>
		<?php echo $form->textField($model,'total_tagihan'); ?>
		<?php echo $form->error($model,'total_tagihan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_tagihan'); ?>
		<?php echo $form->textField($model,'status_tagihan',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'status_tagihan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal_pembayaran'); ?>
		<?php echo $form->textField($model,'tanggal_pembayaran'); ?>
		<?php echo $form->error($model,'tanggal_pembayaran'); ?>
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