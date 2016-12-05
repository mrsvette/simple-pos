<?php
/* @var $this PromosiController */
/* @var $data Promosi */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_promosi')); ?>:</b>
	<?php echo CHtml::encode($data->kode_promosi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deskripsi')); ?>:</b>
	<?php echo CHtml::encode($data->deskripsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis_promosi')); ?>:</b>
	<?php echo CHtml::encode($data->jenis_promosi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nilai_promosi')); ?>:</b>
	<?php echo CHtml::encode($data->nilai_promosi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maksimal_digunakan')); ?>:</b>
	<?php echo CHtml::encode($data->maksimal_digunakan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telah_digunakan')); ?>:</b>
	<?php echo CHtml::encode($data->telah_digunakan); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status_promosi')); ?>:</b>
	<?php echo CHtml::encode($data->status_promosi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('produk_yang_terdiskon')); ?>:</b>
	<?php echo CHtml::encode($data->produk_yang_terdiskon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_mulai_promosi')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_mulai_promosi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_berakhir_promosi')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_berakhir_promosi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_input')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_input); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_input')); ?>:</b>
	<?php echo CHtml::encode($data->user_input); ?>
	<br />

	*/ ?>

</div>