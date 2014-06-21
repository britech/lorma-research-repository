<?php
/* @var $this FolderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Folders',
);

$this->menu=array(
	array('label'=>'Create Folder', 'url'=>array('create')),
	array('label'=>'Manage Folder', 'url'=>array('admin')),
);
?>

<h1>Folders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
