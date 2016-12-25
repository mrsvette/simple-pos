<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="form-group col-md-3">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="form-group col-md-3">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="form-group col-md-3">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',$model->listStatus); ?>
	</div>

	<div class="form-group col-md-3">
		<?php echo $form->label($model,'tanggal_input'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$model, //Model object
			'attribute'=>'tanggal_input', //attribute name
			'id'=>'entry-date',
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd',
				'changeMonth' => 'true',
				'changeYear'=>'true',
				'constrainInput' => 'false'
			),
			'htmlOptions'=>array(
				'class'=>'form-control'
			),
		));
		?>
	</div>

	<div class="form-group col-md-12">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>
