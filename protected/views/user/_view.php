<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_name')); ?>:</b>
	<?php echo CHtml::encode($data->fld_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_email_address')); ?>:</b>
	<?php echo CHtml::encode($data->fld_email_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_restrictions')); ?>:</b>
	<?php echo is_null($data->fld_restrictions) ? "Not Set" : $data->getRestrictionDescription($data->fld_restrictions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_user_stat')); ?>:</b>
	<?php echo $data->fld_user_stat==0 ? "Pending for Activation" : ($data->fld_user_stat==1 ? "Active" : "Blocked"); ?>
	<br />
</div>