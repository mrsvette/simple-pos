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

	<div class="form-group col-md-4">
		<?php echo $form->labelEx($model,'kode_promosi'); ?>
		<?php echo $form->textField($model,'kode_promosi',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'kode_promosi'); ?>
	</div>

	<div class="form-group col-md-4">
		<?php echo $form->labelEx($model,'jenis_promosi'); ?>
		<?php echo $form->dropDownList($model,'jenis_promosi',$model->items()); ?>
		<?php echo $form->error($model,'jenis_promosi'); ?>
	</div>

	<div class="form-group col-md-4">
		<?php echo $form->labelEx($model,'nilai_promosi'); ?>
		<?php echo $form->textField($model,'nilai_promosi'); ?>
		<?php echo $form->error($model,'nilai_promosi'); ?>
	</div>

	<div class="form-group col-md-12">
		<?php echo $form->labelEx($model,'deskripsi'); ?>
		<?php echo $form->textArea($model,'deskripsi',array('rows'=>3, 'cols'=>50)); ?>
		<?php echo $form->error($model,'deskripsi'); ?>
	</div>

	<div class="form-group col-md-4">
		<?php echo $form->labelEx($model,'maksimal_digunakan'); ?>
		<?php echo $form->textField($model,'maksimal_digunakan'); ?>
		<?php echo $form->error($model,'maksimal_digunakan'); ?>
	</div>

	<div class="form-group col-md-4">
		<?php echo $form->labelEx($model,'status_promosi'); ?>
		<?php echo $form->dropDownList($model,'status_promosi',$model->listStatus); ?>
		<?php echo $form->error($model,'status_promosi'); ?>
	</div>

	<div class="form-group col-md-4">
		<?php echo $form->labelEx($model,'produk_yang_terdiskon'); ?>
		<?php echo $form->dropDownList($model,'produk_yang_terdiskon',Produk::list_items(), array('multiple'=>true)); ?>
		<?php echo $form->error($model,'produk_yang_terdiskon'); ?>
	</div>

	<div class="form-group col-md-4">
		<?php echo $form->labelEx($model,'tanggal_mulai_promosi'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'id' => uniqid(),
			'model'=>$model, //Model object
			'attribute'=>'tanggal_mulai_promosi', //attribute name
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd',
				'changeMonth' => 'true',
				'changeYear'=>'true',
				'constrainInput' => 'false'
			),
			'htmlOptions'=>array(
				'class'=>'form-control',
				'value'=>(!empty($model->tanggal_mulai_promosi))? date('Y-m-d',strtotime($model->tanggal_mulai_promosi)) : date('Y-m-d'),
			),
		));
		?>
		<?php echo $form->error($model,'tanggal_mulai_promosi'); ?>
	</div>

	<div class="form-group col-md-4">
		<?php echo $form->labelEx($model,'tanggal_berakhir_promosi'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'id' => uniqid(),
			'model'=>$model, //Model object
			'attribute'=>'tanggal_berakhir_promosi', //attribute name
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd',
				'changeMonth' => 'true',
				'changeYear'=>'true',
				'constrainInput' => 'false'
			),
			'htmlOptions'=>array(
				'class'=>'form-control',
				'value'=>(!empty($model->tanggal_berakhir_promosi))? date('Y-m-d',strtotime($model->tanggal_berakhir_promosi)) : date('Y-m-d'),
			),
		));
		?>
		<?php echo $form->error($model,'tanggal_berakhir_promosi'); ?>
	</div>

	<div class="form-group col-md-12 buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->