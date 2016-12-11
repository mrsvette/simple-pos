<?php echo $this->renderPartial('_search_items', array('model' => $dataProvider->model, 'default' => Yii::app()->user->getState('items_filter'))); ?>

<div class="table-responsive">
    <table class="table table-striped mb30 items">
        <thead>
        <tr>
            <th>No</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Harga</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 0;
        foreach ($dataProvider->data as $data):?>
            <tr class="<?php echo ($no % 2 > 0) ? 'even' : 'odd'; ?>"
                onclick="insertItems('<?php echo $data->id; ?>','<?php echo $this->cleanString($data->nama_produk); ?>');">
                <td style="text-align:center;"><?php echo $no + 1 + $dataProvider->getData()->pageSize * $pages->currentPage; ?></td>
                <td><?php echo $data->id; ?></td>
                <td><?php echo CHtml::link($data->nama_produk, 'javascript:void(0);'); ?></td>
                <td style="text-align:right;"><?php echo number_format($data->harga_produk, 2, ',', '.'); ?></td>
            </tr>
            <?php
            $no++;
        endforeach; ?>
        </tbody>
    </table>
    <br class="clear"/>
    <div class="pager">
        <?php $this->widget('CLinkPager', array('pages' => $dataProvider->pagination, 'id' => 'link_pager', 'htmlOptions' => array('class' => 'dataTables_paginate paging_full_numbers'))) ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#link_pager a').each(function () {
            $(this).click(function (ev) {
                ev.preventDefault();
                $.ajax({
                    'beforeSend': function () {
                        Loading.show();
                    },
                    'complete': function () {
                        Loading.hide();
                    },
                    'url': this.href,
                    'dataType': 'json',
                    'success': function (data) {
                        if (data.status == 'success')
                            $('#div-for-items').html(data.div);
                    },
                });
            });
        });
    });
    function insertItems(item_id, item_name) {
        if (confirm('Tambahkan item "' + item_name + '" ?')) {
            var item = item_id + ' - ' + item_name;
            $.ajax({
                'beforeSend': function () {
                    Loading.show();
                },
                'complete': function () {
                    Loading.hide();
                },
                'url': "<?php echo Yii::app()->createUrl('/transaksi/scan');?>",
                'type': 'post',
                'dataType': 'json',
                'data': {"item": item},
                'success': function (data) {
                    if (data.status == 'success') {
                        $('#sales-frame table.items tbody').html(data.div);
                        $('#sub-total').html(data.subtotal);
                        $('#payment-button').css('display', 'block');
                    } else
                        alert(data.message);
                },
            });
        }
        return false;
    }
</script>
