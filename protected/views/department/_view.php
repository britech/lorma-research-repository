<?php
/* @var $this DepartmentController */
/* @var $data Department */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_dept')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->key_dept), array('view', 'id'=>$data->key_dept)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_code')); ?>:</b>
	<?php echo CHtml::encode($data->fld_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_name')); ?>:</b>
	<?php echo CHtml::encode($data->fld_name); ?>
	<br />


</div>