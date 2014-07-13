<?php
/* @var $this PublicationController */
/* @var $model Publication */
//TODO put title here
$this->breadcrumbs=array(
	'Publications'=>array('index'),
	'Publication Information',
);

$this->profileLink=array(
		array('label'=>'Authors', 'url'=>array('publication/author', 'publication'=>$model->key_pub)),
		array('label'=>'Folders', 'url'=>array('publication/folder', 'publication'=>$model->key_pub)),
		array('label'=>'Files', 'url'=>array('publication/file', 'publication'=>$model->key_pub)),
		array('label'=>'Keywords', 'url'=>array('keyword/index')),
);

$this->menu=array(
		array('label'=>'Update Publication', 'url'=>array('update', 'id'=>$model->key_pub)),
		array('label'=>'Delete Publication', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->key_pub),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Publication Directory', 'url'=>array('index')),
		array('label'=>'Upload a Publication', 'url'=>array('create')),
		array('label'=>'Search a Publication', 'url'=>array('search')),
);
?>

<h1>Publication Information</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fld_pub_title',
		'fld_txt_page',
		'fld_no_page',
		array(
			'name'=>'key_dept',
			'value'=>$model->department->fld_name
		),
		array(
			'name'=>'fld_date_stored',
			'value'=>$model->assembleHumanReadableDate($model->fld_date_stored)
		),
		array(
			'name'=>'fld_is_visible',
			'value'=>$model->getVisibilityDescription($model->fld_is_visible)
		),
	),
)); ?>
