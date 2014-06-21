<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_user')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->key_user), array('view', 'id'=>$data->key_user)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_name')); ?>:</b>
	<?php echo CHtml::encode($data->fld_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_username')); ?>:</b>
	<?php echo CHtml::encode($data->fld_username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_password')); ?>:</b>
	<?php echo CHtml::encode($data->fld_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_email_address')); ?>:</b>
	<?php echo CHtml::encode($data->fld_email_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_restrictions')); ?>:</b>
	<?php echo CHtml::encode($data->fld_restrictions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_user_stat')); ?>:</b>
	<?php echo CHtml::encode($data->fld_user_stat); ?>
	<br />


</div>