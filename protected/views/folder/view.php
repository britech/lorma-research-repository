<?php
/* @var $this FolderController */
/* @var $model Folder */

$this->breadcrumbs=array(
	'Folders'=>array('index'),
	$model->key_folder_group,
);

$this->menu=array(
	array('label'=>'List Folder', 'url'=>array('index')),
	array('label'=>'Create Folder', 'url'=>array('create')),
	array('label'=>'Update Folder', 'url'=>array('update', 'id'=>$model->key_folder_group)),
	array('label'=>'Delete Folder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->key_folder_group),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Folder', 'url'=>array('admin')),
);
?>

<h1>View Folder #<?php echo $model->key_folder_group; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'key_folder_group',
		'fld_group_name',
		'fld_description',
	),
)); ?>
