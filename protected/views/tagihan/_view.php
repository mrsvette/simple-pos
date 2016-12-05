<?php
/* @var $this TagihanController */
/* @var $data Tagihan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nomor_tagihan')); ?>:</b>
	<?php echo CHtml::encode($data->nomor_tagihan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pelanggan')); ?>:</b>
	<?php echo CHtml::encode($data->id_pelanggan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_tagihan')); ?>:</b>
	<?php echo CHtml::encode($data->total_tagihan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_tagihan')); ?>:</b>
	<?php echo CHtml::encode($data->status_tagihan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_pembayaran')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_pembayaran); ?>
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