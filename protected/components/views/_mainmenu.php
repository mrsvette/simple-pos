<?php
$this->widget('zii.widgets.CMenu', array(
    'items' => array(
        array('label' => '<i class="fa fa-money"></i> <span>Tagihan</span><b class="arrow icon-angle-down"></b>', 'url' => '#',
            'items' => array(
                array('label' => '<i class="fa fa-caret-right"></i> Daftar Tagihan', 'url' => array('/tagihan/view'), 'visible' => UserAccess::hasAccess('invoices', Yii::app()->user->id, 'read_p')),
            ),
            'itemOptions' => array('class' => 'nav-parent'),
            'linkOptions' => array('class' => 'expand'),
            'visible' => UserAccess::hasAccess('invoices', Yii::app()->user->id, 'read')
        ),
        array('label' => '<i class="fa fa-suitcase"></i> <span>Produk</span><b class="arrow icon-angle-down"></b>', 'url' => '#',
            'items' => array(
                array('label' => '<i class="fa fa-caret-right"></i> Daftar Produk', 'url' => array('/produk/view'), 'visible' => UserAccess::hasAccess('products', Yii::app()->user->id, 'read_p')),
                array('label' => '<i class="fa fa-caret-right"></i> Tambah Produk', 'url' => array('/produk/create'), 'visible' => UserAccess::hasAccess('products', Yii::app()->user->id, 'create_p')),
            ),
            'itemOptions' => array('class' => 'nav-parent'),
            'linkOptions' => array('class' => 'expand'),
            'visible' => UserAccess::hasAccess('products', Yii::app()->user->id, 'read')
        ),
        array('label' => '<i class="fa fa-file-text-o"></i> <span>' . Yii::t('order', 'Promo') . '</span><b class="arrow icon-angle-down"></b>', 'url' => '#',
            'items' => array(
                array('label' => '<i class="fa fa-caret-right"></i> Daftar Promosi', 'url' => array('/promo/view'), 'visible' => UserAccess::hasAccess('promos', Yii::app()->user->id, 'read_p')),
                array('label' => '<i class="fa fa-caret-right"></i> Tambah Promosi', 'url' => array('/promo/create'), 'visible' => UserAccess::hasAccess('promos', Yii::app()->user->id, 'create_p')),
            ),
            'itemOptions' => array('class' => 'nav-parent'),
            'linkOptions' => array('class' => 'expand'),
            'visible' => UserAccess::hasAccess('promos', Yii::app()->user->id, 'read')
        ),
        /*array('label' => '<i class="fa fa-bar-chart-o"></i> <span>' . Yii::t('order', 'Statistic') . '</span><b class="arrow icon-angle-down"></b>', 'url' => '#',
            'items' => array(
                array('label' => '<i class="fa fa-caret-right"></i> ' . Yii::t('order', 'Income'), 'url' => array('/reports/view'), 'visible' => UserAccess::hasAccess('reports', Yii::app()->user->id, 'read_p')),
                array('label' => '<i class="fa fa-caret-right"></i> ' . Yii::t('order', 'Analytic'), 'url' => array('/reports/analytic'), 'visible' => UserAccess::hasAccess('reports', Yii::app()->user->id, 'read_p')),
            ),
            'itemOptions' => array('class' => 'nav-parent'),
            'linkOptions' => array('class' => 'expand'),
            'visible' => UserAccess::hasAccess('reports', Yii::app()->user->id, 'read_p')
        ),*/
        array('label' => '<i class="fa fa-wrench"></i> <span>Kelola</span><b class="arrow icon-angle-down"></b>', 'url' => '#',
            'items' => array(
                array('label' => '<i class="fa fa-caret-right"></i> Users', 'url' => array('/user/view'), 'visible' => UserAccess::hasAccess('users', Yii::app()->user->id, 'read_p')),
            ),
            'itemOptions' => array('class' => 'nav-parent'),
            'linkOptions' => array('class' => 'expand'),
            'visible' => UserAccess::hasAccess('users', Yii::app()->user->id, 'read') || UserAccess::hasAccess('params', Yii::app()->user->id, 'read')
        ),
        array('label' => '<i class="fa fa-power-off"></i> <span>Logout</span>', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
    ),
    'htmlOptions' => array('class' => 'navigation'),
    'encodeLabel' => false,
    'activeCssClass' => 'active',
    'submenuHtmlOptions' => array('class' => 'children')
));
?>
