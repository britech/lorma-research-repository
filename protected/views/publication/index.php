<?php
/* @var $this PublicationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Publications',
);

$this->menu=array(
	array('label'=>'Upload a Publication', 'url'=>array('create')),
	array('label'=>'Manage Folder Groups', 'url'=>array('folder/index')),
	array('label'=>'Search a Publication', 'url'=>array('search')),
);
?>

<h1>Publications</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
