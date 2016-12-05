<?php
/* @var $this PelangganController */
/* @var $model Pelanggan */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_pelanggan'); ?>
		<?php echo $form->textField($model,'nama_pelanggan',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_pelanggan'); ?>
		<?php echo $form->textField($model,'email_pelanggan',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telepon_pelanggan'); ?>
		<?php echo $form->textField($model,'telepon_pelanggan',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alamat_pelanggan'); ?>
		<?php echo $form->textArea($model,'alamat_pelanggan',array('rows'=>6, 'cols'=>50)); ?>
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