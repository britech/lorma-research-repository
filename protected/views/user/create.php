<?php
/* @var $this UserController */
/* @var $model User */
$this->pageTitle = Yii::app()->name.' - Register a User';

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Register a User',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Register a User</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>