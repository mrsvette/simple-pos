<?php
/* @var $this TagihanController */
/* @var $model Tagihan */

$this->breadcrumbs = array(
    'Tagihan' => array('index'),
    'Tambah',
);

$this->menu = array(
    array('label' => 'Kelola Data Transaksi', 'url' => array('admin')),
    array('label' => 'Kelola Data Produk', 'url' => array('admin')),
);
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-briefcase"></i> Transaksi Penjualan</h4>
        </div>
        <div class="panel-body">
            <?php echo $this->renderPartial('_form', array('model' => $model, 'promocode' => $promocode)); ?>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('.page-container').toggleClass('hidden-sidebar');
            $('.sidebar').hide();
        });
    </script>