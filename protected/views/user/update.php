<?php
/* @var $this UserController */
/* @var $model User */
$title = "Update User Information";

$this->pageTitle = Yii::app()->name.' - '.$title;
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->fld_name=>array('view','id'=>$model->key_user),
	$title,
);

$this->menu=array(
	array('label'=>'User Directory', 'url'=>array('index')),
	array('label'=>'Register a User', 'url'=>array('create')),
	array('label'=>'User Information', 'url'=>array('view', 'id'=>$model->key_user)),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1><?php echo $title;?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>