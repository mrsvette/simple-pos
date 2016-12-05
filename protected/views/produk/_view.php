<?php
/* @var $this ProdukController */
/* @var $data Produk */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_produk')); ?>:</b>
	<?php echo CHtml::encode($data->nama_produk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deskripsi_produk')); ?>:</b>
	<?php echo CHtml::encode($data->deskripsi_produk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis_produk')); ?>:</b>
	<?php echo CHtml::encode($data->jenis_produk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('harga_produk')); ?>:</b>
	<?php echo CHtml::encode($data->harga_produk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_input')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_input); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_input')); ?>:</b>
	<?php echo CHtml::encode($data->user_input); ?>
	<br />


</div>