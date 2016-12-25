<?php
$this->breadcrumbs = array(
	'Users' => array('view'),
	Yii::t('global','View'),
);

$this->menu=array(
	array('label'=>Yii::t('global','List').' User', 'url'=>array('view'),'visible'=>UserAccess::ruleAccess('read_p')),
	array('label'=>Yii::t('global','Create').' User', 'url'=>array('create'), 'visible'=>UserAccess::ruleAccess('create_p')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo Yii::t('global','List');?> Users</h4>
	</div>
	<div class="panel-body">
		<p><?php echo Yii::t('global','You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.');?></p>

		<?php echo CHtml::link(Yii::t('global','Advanced Search'),'#',array('class'=>'search-button')); ?>
		<div class="search-form" style="display:none">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->
		<div class="table-responsive">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'user-grid',
			'dataProvider'=>$model->search(),
			'itemsCssClass'=>'table table-striped mb30',
			'afterAjaxUpdate' => 'reinstallDatePicker', // (#1
			'filter'=>$model,
			'columns'=>array(
				array(
					'value'=>'$this->grid->dataProvider->getPagination()->getOffset()+$row+1',
				),
				'username',
				array(
					'name'=>'status',
					'value'=>'$data->statusInText',
					'filter'=>$model->getListStatus(),
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'text-align:center;'),
				),
				array(
					'name'=>'tanggal_input',
					'value'=>'date("d M Y H:i:s",strtotime($data->tanggal_input))',
					'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model'=>$model, 
						'attribute'=>'tanggal_input', 
						'language' => 'id',
						'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', // (#2)
						'htmlOptions' => array(
							'id' => 'datepicker_for_tanggal_input',
							'size' => '10',
						),
						'defaultOptions' => array(  // (#3)
							'showOn' => 'focus', 
							'dateFormat' => 'yy-mm-dd',
							'showOtherMonths' => true,
							'selectOtherMonths' => true,
							'changeMonth' => true,
							'changeYear' => true,
							'showButtonPanel' => true,
						)
						), 
						true), // (#4)
					'htmlOptions'=>array('style'=>'text-align:center'),
				),
				array(
					'class'=>'CButtonColumn',
					'template'=>'{update}{delete}{priviledge}',
					'buttons'=>array
						(
							'update'=>array(
									'imageUrl'=>false,
									'label'=>'<i class="fa fa-pencil"></i>',
									'options'=>array('title'=>'Update'),
									'visible'=>'UserAccess::ruleAccess(\'update_p\')',
								),
							'delete'=>array(
									'imageUrl'=>false,
									'label'=>'<i class="fa fa-trash-o"></i>',
									'options'=>array('title'=>'Delete'),
									'visible'=>'UserAccess::ruleAccess(\'delete_p\')',
								),	
							'priviledge' => array
								(
									'label'=>'<i class="fa fa-eye"></i>',
									'options'=>array('title'=>'Priviledge'),
									'url'=>'Yii::app()->createUrl("/user/priviledge", array("id"=>$data->id))',
									'visible'=>'UserAccess::ruleAccess(\'delete_p\')',
								),
						),
					'visible'=>UserAccess::ruleAccess('update_p'),
					'htmlOptions'=>array('style'=>'width:10%;','class'=>'table-action'),
				),
			),
		)); ?>
		</div>
	</div>
</div>
<?php
// (#5)
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_tanggal_input').datepicker();
	$('input[type=text]').addClass('form-control');
	$('select').addClass('form-control');
	$('.yiiPager').addClass('dataTables_paginate paging_full_numbers');
	$('.dataTables_paginate').removeClass('yiiPager');
}
");
?>
