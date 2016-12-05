<?php
/* @var $this ProdukDiskonController */
/* @var $data ProdukDiskon */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_produk')); ?>:</b>
	<?php echo CHtml::encode($data->id_produk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah_produk')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah_produk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('harga_produk')); ?>:</b>
	<?php echo CHtml::encode($data->harga_produk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_mulai_diskon')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_mulai_diskon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_berakhir_diskon')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_berakhir_diskon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_input')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_input); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_input')); ?>:</b>
	<?php echo CHtml::encode($data->user_input); ?>
	<br />

	*/ ?>

</div>