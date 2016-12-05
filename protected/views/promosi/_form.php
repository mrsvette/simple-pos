<?php
/* @var $this PromosiController */
/* @var $model Promosi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promosi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_promosi'); ?>
		<?php echo $form->textField($model,'kode_promosi',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'kode_promosi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deskripsi'); ?>
		<?php echo $form->textArea($model,'deskripsi',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'deskripsi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jenis_promosi'); ?>
		<?php echo $form->textField($model,'jenis_promosi',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'jenis_promosi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nilai_promosi'); ?>
		<?php echo $form->textField($model,'nilai_promosi'); ?>
		<?php echo $form->error($model,'nilai_promosi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maksimal_digunakan'); ?>
		<?php echo $form->textField($model,'maksimal_digunakan'); ?>
		<?php echo $form->error($model,'maksimal_digunakan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telah_digunakan'); ?>
		<?php echo $form->textField($model,'telah_digunakan'); ?>
		<?php echo $form->error($model,'telah_digunakan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_promosi'); ?>
		<?php echo $form->textField($model,'status_promosi',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'status_promosi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'produk_yang_terdiskon'); ?>
		<?php echo $form->textArea($model,'produk_yang_terdiskon',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'produk_yang_terdiskon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal_mulai_promosi'); ?>
		<?php echo $form->textField($model,'tanggal_mulai_promosi'); ?>
		<?php echo $form->error($model,'tanggal_mulai_promosi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal_berakhir_promosi'); ?>
		<?php echo $form->textField($model,'tanggal_berakhir_promosi'); ?>
		<?php echo $form->error($model,'tanggal_berakhir_promosi'); ?>
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