<?php
/* @var $this PublicationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Publications',
);

$this->menu=array(
	array('label'=>'Upload a Publication', 'url'=>array('create'), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->checkAccess(User::RESTRICTION_REGULAR))),
	array('label'=>'Manage Folder Groups', 'url'=>array('folder/index'), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->checkAccess(User::RESTRICTION_REGULAR))),
	array('label'=>'Search a Publication', 'url'=>array('search')),
);
?>

<h1>Publications</h1>

<?php 
if(Yii::app()->user->isGuest || Yii::app()->user->checkAccess(User::RESTRICTION_REGULAR)){
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); 	
} else{
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'fld_pub_title',
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view}',
			),
		),
	));
}
?>
