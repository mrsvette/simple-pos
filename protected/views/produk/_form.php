<?php
/* @var $this ProdukController */
/* @var $model Produk */
/* @var $form CActiveForm */
?>
<ul class="nav nav-tabs">
	<li class="active">
		<a data-toggle="tab" href="#general">
			<strong>Informasi Produk</strong>
		</a>
	</li>
	<li class="">
		<a data-toggle="tab" href="#price">
			<strong>Harga Diskon</strong>
		</a>
	</li>
</ul>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'produk-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="tab-content pill-content">
	<div id="general" class="tab-pane active">
		<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-warning alert-block alert-dismissable fade in')); ?>

		<div class="form-group col-md-4">
			<?php echo $form->labelEx($model,'nama_produk',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'nama_produk',array('class'=>'form-control')); ?>
		</div>

		<div class="form-group col-md-4">
			<?php echo $form->labelEx($model,'jenis_produk',array('class'=>'control-label')); ?>
			<?php echo $form->dropDownList($model,'jenis_produk',$model->listType,array('class'=>'form-control')); ?>
		</div>
		<div class="form-group col-md-4 mb20">
			<?php echo $form->labelEx($model,'harga_produk',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'harga_produk',array('class'=>'form-control')); ?>
		</div>

		<div class="form-group col-md-8">
			<?php echo $form->labelEx($model,'deskripsi_produk',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'deskripsi_produk',array('class'=>'form-control')); ?>
		</div>
	</div>
	<div id="price" class="tab-pane">
		<div class="form-group col-md-4">
			<?php echo $form->labelEx($model,'harga_produk',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'harga_produk',array('class'=>'form-control')); ?>
		</div>
	</div>
</div>
<div class="form-group col-md-12 mt10">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'),array('style'=>'min-width:100px;')); ?>
</div>
<?php $this->endWidget(); ?>