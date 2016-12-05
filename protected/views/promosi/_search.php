<?php
/* @var $this PromosiController */
/* @var $model Promosi */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_promosi'); ?>
		<?php echo $form->textField($model,'kode_promosi',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deskripsi'); ?>
		<?php echo $form->textArea($model,'deskripsi',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jenis_promosi'); ?>
		<?php echo $form->textField($model,'jenis_promosi',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nilai_promosi'); ?>
		<?php echo $form->textField($model,'nilai_promosi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maksimal_digunakan'); ?>
		<?php echo $form->textField($model,'maksimal_digunakan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telah_digunakan'); ?>
		<?php echo $form->textField($model,'telah_digunakan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_promosi'); ?>
		<?php echo $form->textField($model,'status_promosi',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'produk_yang_terdiskon'); ?>
		<?php echo $form->textArea($model,'produk_yang_terdiskon',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal_mulai_promosi'); ?>
		<?php echo $form->textField($model,'tanggal_mulai_promosi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal_berakhir_promosi'); ?>
		<?php echo $form->textField($model,'tanggal_berakhir_promosi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal_input'); ?>
		<?php echo $form->textField($model,'tanggal_input'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_input'); ?>
		<?php echo $form->textField($model,'user_input'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->