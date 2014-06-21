<?php
/* @var $this PublicationController */
/* @var $model Publication */

$this->breadcrumbs=array(
	'Publications'=>array('index'),
	$model->key_pub=>array('view','id'=>$model->key_pub),
	'Update',
);

$this->menu=array(
	array('label'=>'List Publication', 'url'=>array('index')),
	array('label'=>'Create Publication', 'url'=>array('create')),
	array('label'=>'View Publication', 'url'=>array('view', 'id'=>$model->key_pub)),
	array('label'=>'Manage Publication', 'url'=>array('admin')),
);
?>

<h1>Update Publication <?php echo $model->key_pub; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>