<?php
/* @var $this TagihanController */
/* @var $model Tagihan */
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
		<?php echo $form->label($model,'nomor_tagihan'); ?>
		<?php echo $form->textField($model,'nomor_tagihan',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pelanggan'); ?>
		<?php echo $form->textField($model,'id_pelanggan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_tagihan'); ?>
		<?php echo $form->textField($model,'total_tagihan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_tagihan'); ?>
		<?php echo $form->textField($model,'status_tagihan',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal_pembayaran'); ?>
		<?php echo $form->textField($model,'tanggal_pembayaran'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal_input'); ?>
		<?php echo $form->textField($model,'tanggal_input'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->