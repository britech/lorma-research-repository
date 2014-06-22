<?php
/* @var $this FileController */
/* @var $data File */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_pub_file')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->key_pub_file), array('view', 'id'=>$data->key_pub_file)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_file_title')); ?>:</b>
	<?php echo CHtml::encode($data->fld_file_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_folder_group')); ?>:</b>
	<?php echo CHtml::encode($data->key_folder_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_file_position')); ?>:</b>
	<?php echo CHtml::encode($data->fld_file_position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_no_pages')); ?>:</b>
	<?php echo CHtml::encode($data->fld_no_pages); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_pub')); ?>:</b>
	<?php echo CHtml::encode($data->key_pub); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_dload_restriction')); ?>:</b>
	<?php echo CHtml::encode($data->fld_dload_restriction); ?>
	<br />


</div>