<?php
/* @var $this PublicationController */
/* @var $data Publication */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_pub')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->key_pub), array('view', 'id'=>$data->key_pub)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_pub_title')); ?>:</b>
	<?php echo CHtml::encode($data->fld_pub_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_txt_page')); ?>:</b>
	<?php echo CHtml::encode($data->fld_txt_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_no_page')); ?>:</b>
	<?php echo CHtml::encode($data->fld_no_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_location')); ?>:</b>
	<?php echo CHtml::encode($data->fld_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_dept')); ?>:</b>
	<?php echo CHtml::encode($data->key_dept); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_date_stored')); ?>:</b>
	<?php echo CHtml::encode($data->fld_date_stored); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_format_type')); ?>:</b>
	<?php echo CHtml::encode($data->fld_format_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_is_visible')); ?>:</b>
	<?php echo CHtml::encode($data->fld_is_visible); ?>
	<br />

	*/ ?>

</div>