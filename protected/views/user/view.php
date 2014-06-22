<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->fld_name,
);

$defaultLinks=array(array('label'=>'User Directory', 'url'=>array('index')),
					array('label'=>'Register a User', 'url'=>array('create')),
					array('label'=>'Manage Users', 'url'=>array('admin')));

switch($model->fld_user_stat){
	case 0:
		$additionalLinks=array(array('label'=>'Activate Account', 'url'=>array('updateStatus', 'id'=>$model->key_user, 'stat'=>1)));
		break;
	
	case 1:
		$additionalLinks=array(array('label'=>'Update User Information', 'url'=>array('update', 'id'=>$model->key_user)),
							   array('label'=>'Deactivate Account', 'url'=>array('updateStatus', 'id'=>$model->key_user, 'stat'=>0)),
							   array('label'=>'Block Account', 'url'=>array('updateStatus', 'id'=>$model->key_user, 'stat'=>-1)));
		break;
		
	default:
		$additionalLinks=array(array('label'=>'Deactivate Account', 'url'=>array('updateStatus', 'id'=>$model->key_user, 'stat'=>1)),
							   array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->key_user),'confirm'=>'Are you sure you want to delete this item?')));
		
}
$this->menu=array_merge($defaultLinks, $additionalLinks);
?>

<h1><?php echo $model->fld_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'key_user',
		'fld_email_address',
		/* 'fld_name', */
		'fld_username',
		array(
			'name'=>'fld_password',
			'value'=>hash_hmac('sha1', $model->fld_password, $model->fld_password)
		),
		array(
			'name'=>'fld_restrictions',
			'value'=>is_null($model->fld_restrictions) ? "Not Set" : $model->getRestrictionDescription($model->fld_restrictions)
		),
		array(
			'name'=>'fld_user_stat',
			'value'=>$model->getStatusDescription($model->fld_user_stat)
		),
	),
)); ?>
