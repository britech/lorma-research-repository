<?php
/* @var $this FolderController */
/* @var $data Folder */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_folder_group')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->key_folder_group), array('view', 'id'=>$data->key_folder_group)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_group_name')); ?>:</b>
	<?php echo CHtml::encode($data->fld_group_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fld_description')); ?>:</b>
	<?php echo CHtml::encode($data->fld_description); ?>
	<br />


</div>