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

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
