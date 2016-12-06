<?php
/* @var $this TagihanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Tagihans',
);

$this->menu = array(
    array('label' => 'Tagihan Baru', 'url' => array('create')),
    array('label' => 'Kelola Tagihan', 'url' => array('admin')),
);
?>

<h1>Tagihans</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
