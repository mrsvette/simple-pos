<?php
/* @var $this ProdukDiskonController */
/* @var $model ProdukDiskon */
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
		<?php echo $form->label($model,'id_produk'); ?>
		<?php echo $form->textField($model,'id_produk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jumlah_produk'); ?>
		<?php echo $form->textField($model,'jumlah_produk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'harga_produk'); ?>
		<?php echo $form->textField($model,'harga_produk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal_mulai_diskon'); ?>
		<?php echo $form->textField($model,'tanggal_mulai_diskon'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal_berakhir_diskon'); ?>
		<?php echo $form->textField($model,'tanggal_berakhir_diskon'); ?>
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