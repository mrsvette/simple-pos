<?php
/* @var $this PelangganController */
/* @var $data Pelanggan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_pelanggan')); ?>:</b>
	<?php echo CHtml::encode($data->nama_pelanggan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_pelanggan')); ?>:</b>
	<?php echo CHtml::encode($data->email_pelanggan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telepon_pelanggan')); ?>:</b>
	<?php echo CHtml::encode($data->telepon_pelanggan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alamat_pelanggan')); ?>:</b>
	<?php echo CHtml::encode($data->alamat_pelanggan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_input')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_input); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_input')); ?>:</b>
	<?php echo CHtml::encode($data->user_input); ?>
	<br />


</div>