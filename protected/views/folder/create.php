<?php
/* @var $this FolderController */
/* @var $model Folder */

$this->breadcrumbs=array(
	'Folders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Folder', 'url'=>array('index')),
	array('label'=>'Manage Folder', 'url'=>array('admin')),
);
?>

<h1>Create Folder</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>