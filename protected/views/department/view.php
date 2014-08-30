<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	'Department Info',
);

$this->menu=array(
	array('label'=>'Manage Departments', 'url'=>array('index')),
	array('label'=>'Update Department Info', 'url'=>array('update', 'id'=>$model->key_dept)),
	array('label'=>'Delete Department', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->key_dept),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Linked Publications', 'url'=>array('publication/searchByDepartment', 'department'=>$model->key_dept)),
);
?>

<h1>Department Info</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fld_code',
		'fld_name',
	),
)); ?>
