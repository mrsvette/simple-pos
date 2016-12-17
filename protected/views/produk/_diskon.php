<?php if (!is_array($models)):?>
<?php $models = array($models); ?>
<?php endif; ?>
<?php foreach ($models as $i => $model): ?>
<div id="<?php echo ($i == 0)? 'diskon-form' : 'diskon-form-'.$i; ?>" class="row">
    <div class="form-group col-md-2">
        <?php echo $form->labelEx($model,'jumlah_produk',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'jumlah_produk[]',array('class'=>'form-control', 'value' => $model->jumlah_produk)); ?>
    </div>
    <div class="form-group col-md-2">
        <?php echo $form->labelEx($model,'harga_produk',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'harga_produk[]',array('class'=>'form-control', 'value' => $model->harga_produk)); ?>
    </div>
    <div class="form-group col-md-3">
        <?php echo $form->labelEx($model,'tanggal_mulai_diskon',array('class'=>'control-label')); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'id' => uniqid(),
            'model'=>$model, //Model object
            'attribute'=>'tanggal_mulai_diskon[]', //attribute name
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
                'changeMonth' => 'true',
                'changeYear'=>'true',
                'constrainInput' => 'false'
            ),
            'htmlOptions'=>array(
                'class'=>'form-control',
                'value'=>(!empty($model->tanggal_mulai_diskon))? date('Y-m-d',strtotime($model->tanggal_mulai_diskon)) : date('Y-m-d'),
            ),
        ));
        ?>
    </div>
    <div class="form-group col-md-3">
        <?php echo $form->labelEx($model,'tanggal_berakhir_diskon',array('class'=>'control-label')); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'id' => uniqid(),
            'model'=>$model, //Model object
            'attribute'=>'tanggal_berakhir_diskon[]', //attribute name
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
                'changeMonth' => 'true',
                'changeYear'=>'true',
                'constrainInput' => 'false'
            ),
            'htmlOptions'=>array(
                'class'=>'form-control',
                'value'=>(!empty($model->tanggal_berakhir_diskon))? date('Y-m-d',strtotime($model->tanggal_berakhir_diskon)) : date('Y-m-d', strtotime('+1 day')),
            ),
        ));
        ?>
    </div>
    <div class="form-group col-md-2">
        <label class="control-label">&nbsp;</label>
        <div class="col-md-12">
            <?php echo CHTML::link('<i class="fa fa-plus fa-2x"></i>', 'javascript:void(0);', array('onclick' => 'addDiskon(this);', 'title' => 'Tambah diskon')); ?>
            <?php if (!empty($model->id)): ?>
                <?php echo CHTML::link('<i class="fa fa-trash-o fa-2x"></i>', 'javascript:void(0);', array('onclick' => 'removeDiskon(this);', 'title' => 'Hapus diskon', 'attr-id' => $model->id, 'class' => 'remove-discount', 'attr-href' => Yii::app()->createUrl('/produk/deleteDiscount', array('id' => $model->id)))); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endforeach; ?>
<script type="application/javascript">
    function addDiskon(data) {
        var price_form = $('#diskon-form').html();
        var count = $('#price').find('.row').length;
        //gandakan form diskon dari #diskon-form
        $('#price').append('<div id="clone-'+count+'" class="row clone">' + price_form + '</div>');
        $('#clone-' + count).find('input').val('');
        $('#clone-' + count).find('.remove-discount').removeAttr('attr-id');
        $('#clone-' + count).find('.remove-discount').attr('href', 'javascript:void(0);');
        //atur ulang datepicker-nya
        $('#clone-' + count).find('.hasDatepicker').each(function(i){
            $(this).attr('id', 'date-picker-' + count + '-' + i).removeClass('hasDatepicker').removeData('datepicker').unbind().datepicker({'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','changeYear':'true','constrainInput':'false'});
        });
        //default jumlah_produk = 1
        $('#clone-' + count).find('#ProdukDiskon_jumlah_produk').val(1);
    }
    function removeDiskon(data) {
        if (confirm('Anda yakin ingin menghapus item ini?')){
            //hapus section diskon
            if($(data).attr('attr-id')>0){
                $.ajax({
                    'beforeSend': function() { Loading.show(); },
                    'complete': function() { Loading.hide(); },
                    'url': $(data).attr('attr-href'),
                    'type':'post',
                    'dataType': 'json',
                    'success': function(result){
                        if(result.status == 'success'){
                            $(data).parent().parent().parent().remove();
                        }
                    },
                });
                return false;
            }else
                $(data).parent().parent().parent().remove();
        }
        return false;
    }
</script>