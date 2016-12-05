<?php
/* @var $this ProdukController */
/* @var $model Produk */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'produk-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_produk'); ?>
		<?php echo $form->textField($model,'nama_produk',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'nama_produk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deskripsi_produk'); ?>
		<?php echo $form->textArea($model,'deskripsi_produk',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'deskripsi_produk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jenis_produk'); ?>
		<?php echo $form->textField($model,'jenis_produk',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'jenis_produk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'harga_produk'); ?>
		<?php echo $form->textField($model,'harga_produk'); ?>
		<?php echo $form->error($model,'harga_produk'); ?>
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