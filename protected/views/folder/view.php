<?php
/* @var $this FolderController */
/* @var $model Folder */
$this->pageTitle=Yii::app()->name.' - Folder Group';
$this->breadcrumbs=array(
	'Publications'=>array('publication/index'),
	'Folders'=>array('index'),
	$model->fld_group_name,
);

$this->menu=array(
	array('label'=>'Manage Folder Groups', 'url'=>array('index')),
	array('label'=>'Update Folder Group', 'url'=>array('update', 'id'=>$model->key_folder_group)),
	array('label'=>'Delete Folder Group', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->key_folder_group),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>Folder Information</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fld_group_name',
		array(
			'name'=>'fld_description',
			'value'=>nl2br($model->fld_description)
		),
	),
)); ?>
