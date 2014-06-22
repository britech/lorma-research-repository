<?php
/* @var $this AuthorController */
/* @var $data Author */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_author')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->key_author), array('view', 'id'=>$data->key_author)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_lname')); ?>:</b>
	<?php echo CHtml::encode($data->fld_lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_fname')); ?>:</b>
	<?php echo CHtml::encode($data->fld_fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_mname')); ?>:</b>
	<?php echo CHtml::encode($data->fld_mname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_dept')); ?>:</b>
	<?php echo CHtml::encode($data->key_dept); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_pub')); ?>:</b>
	<?php echo CHtml::encode($data->key_pub); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_designation')); ?>:</b>
	<?php echo CHtml::encode($data->fld_designation); ?>
	<br />


</div>