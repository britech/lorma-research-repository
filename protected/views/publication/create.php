<?php
/* @var $this PublicationController */
/* @var $model Publication */

$this->breadcrumbs=array(
	'Publications'=>array('index'),
	'Upload a Publication',
);

$this->menu=array(
	array('label'=>'Publication Directory', 'url'=>array('index')),
	array('label'=>'Search a Publication', 'url'=>array('search')),
);
?>

<h1>Upload a Publication</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'deptList'=>$deptList)); ?>