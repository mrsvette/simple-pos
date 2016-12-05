<?php
/* @var $this ProdukController */
/* @var $model Produk */
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
		<?php echo $form->label($model,'nama_produk'); ?>
		<?php echo $form->textField($model,'nama_produk',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deskripsi_produk'); ?>
		<?php echo $form->textArea($model,'deskripsi_produk',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jenis_produk'); ?>
		<?php echo $form->textField($model,'jenis_produk',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'harga_produk'); ?>
		<?php echo $form->textField($model,'harga_produk'); ?>
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