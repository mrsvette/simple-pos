<?php
/* @var $this ProdukDiskonController */
/* @var $model ProdukDiskon */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'produk-diskon-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_produk'); ?>
		<?php echo $form->textField($model,'id_produk'); ?>
		<?php echo $form->error($model,'id_produk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jumlah_produk'); ?>
		<?php echo $form->textField($model,'jumlah_produk'); ?>
		<?php echo $form->error($model,'jumlah_produk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'harga_produk'); ?>
		<?php echo $form->textField($model,'harga_produk'); ?>
		<?php echo $form->error($model,'harga_produk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal_mulai_diskon'); ?>
		<?php echo $form->textField($model,'tanggal_mulai_diskon'); ?>
		<?php echo $form->error($model,'tanggal_mulai_diskon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal_berakhir_diskon'); ?>
		<?php echo $form->textField($model,'tanggal_berakhir_diskon'); ?>
		<?php echo $form->error($model,'tanggal_berakhir_diskon'); ?>
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