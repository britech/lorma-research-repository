<?php
/* @var $this PublicationController */
/* @var $model Publication */

$this->breadcrumbs=array(
	'Publications'=>array('index'),
	$model->key_pub,
);

$this->menu=array(
	array('label'=>'List Publication', 'url'=>array('index')),
	array('label'=>'Create Publication', 'url'=>array('create')),
	array('label'=>'Update Publication', 'url'=>array('update', 'id'=>$model->key_pub)),
	array('label'=>'Delete Publication', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->key_pub),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Publication', 'url'=>array('admin')),
);
?>

<h1>View Publication #<?php echo $model->key_pub; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'key_pub',
		'fld_pub_title',
		'fld_txt_page',
		'fld_no_page',
		'fld_location',
		'key_dept',
		'fld_date_stored',
		'fld_format_type',
		'fld_is_visible',
	),
)); ?>
