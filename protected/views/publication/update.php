<?php
/* @var $this PublicationController */
/* @var $model Publication */

$this->breadcrumbs=array(
	'Publications'=>array('index'),
	$model->key_pub=>array('view','id'=>$model->key_pub),
	'Update',
);

$this->menu=array(
		array('label'=>'Delete Publication', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->key_pub),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Publication Directory', 'url'=>array('index')),
		array('label'=>'Upload a Publication', 'url'=>array('create')),
		array('label'=>'Search a Publication', 'url'=>array('search')),
);
?>

<h1>Update Publication Information</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'deptList'=>$deptList)); ?>