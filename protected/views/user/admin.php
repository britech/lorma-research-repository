<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'User Directory', 'url'=>array('index')),
	array('label'=>'Register a User', 'url'=>array('create')),
);

/* Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
"); */
?>

<h1>Manage Users</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<!--<div class="search-form" style="display:none">-->
<?php /* $this->renderPartial('_search',array(
	'model'=>$model,
)); */ ?>
<!-- </div> -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		/* 'key_user', */
		array(
			'name'=>'fld_name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->fld_name, array("view", "id"=>$data->key_user))',
			'htmlOptions'=>array('style'=>'width: 80%')
		),
		/* 'fld_username',
		'fld_password',
		'fld_email_address',
		'fld_restrictions', */
		/*
		'fld_user_stat',
		*/
		array(
			'name'=>'fld_user_stat',
			'header'=>'Action',
			'type'=>'raw',
			'value'=>'$data->fld_user_stat==0 ? CHtml::link("Activate Account", array("updateStatus", "id"=>$data->key_user, "stat"=>"1")) : ($data->fld_user_stat==1 ? CHtml::link("Deactivate Account", array("updateStatus", "id"=>$data->key_user, "stat"=>1)) : CHtml::link("Delete Account", array("delete", "id"=>$data->key_user)));',
			'htmlOptions'=>array('style'=>'text-align:center;')
		),
	),
)); ?>
