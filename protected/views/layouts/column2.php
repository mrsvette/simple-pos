<?php $this->beginContent('/layouts/main'); ?>
<!-- Sidebar -->
<div class="sidebar collapse">
    <?php $this->widget('MainMenu');?>
</div><!-- /sidebar -->
<!-- Page content -->
<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-bars"></i> <?php echo Yii::t('menu', 'Dashboard'); ?>
            <small>Selamat datang, <?php echo ucfirst(Yii::app()->user->name); ?>!</small>
        </h5>
        <div class="btn-group">
            <a href="#" class="btn btn-link btn-lg btn-icon dropdown-toggle" data-toggle="dropdown"><i
                    class="fa fa-cog"></i><span class="caret"></span></a>
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'dropdown-menu dropdown-menu-right'),
                'encodeLabel' => false,
            ));
            ?>
        </div>
    </div>
    <!-- /page title -->

    <?php echo $content; ?>

    <!-- Footer -->
    <div class="footer">
        &copy; Copyright 2015. All rights reserved.</a>
    </div>
    <!-- /footer -->

</div>
</div>
<?php $this->endContent(); ?>
<script type="text/javascript">
    if (window.addEventListener) { // W3C standard
        window.addEventListener('load', initDOMContentLoaded, false);
    } else if (window.attachEvent) { // Microsoft
        window.attachEvent('onload', initDOMContentLoaded);
    }
    function initDOMContentLoaded() {
        if (typeof jQuery == 'undefined') {
            setTimeout(function () {
                $(function () {
                    dataReload();
                });
            }, 3000);
        } else {
            $(function () {
                dataReload();
            });
        }
    }
    function reloadGrid(id, data) {
        dataReload();
        return false;
    }
    function dataReload() {
        $('input[type=text]').addClass('form-control');
        $('textarea').addClass('form-control');
        $('select').addClass('form-control');
        $('input[type=password]').addClass('form-control');
        $('input[type=submit]').addClass('btn btn-primary');
        $('input[type=button]').addClass('btn btn-primary');
        $('.yiiPager').addClass('dataTables_paginate paging_full_numbers');
        $('.dataTables_paginate').removeClass('yiiPager');
        return false;
    }
</script>
