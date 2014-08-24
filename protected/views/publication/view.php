<?php
/* @var $this PublicationController */
/* @var $model Publication */
//TODO put title here
$this->breadcrumbs=array(
	'Publications'=>array('index'),
	'Publication Information',
);?>
<h1>Publication Information</h1>
<?php
$this->profileLink=array(
		array('label'=>'Authors', 'url'=>array('publication/author', 'publication'=>$model->key_pub), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
		array('label'=>'Folders', 'url'=>array('publication/folder', 'publication'=>$model->key_pub), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
		array('label'=>'Files', 'url'=>array('publication/file', 'publication'=>$model->key_pub)),
		array('label'=>'Keywords', 'url'=>array('publication/keyword', 'publication'=>$model->key_pub), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
);
	
$this->menu=array(
		array('label'=>'Update Publication', 'url'=>array('update', 'id'=>$model->key_pub), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
		array('label'=>'Delete Publication', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->key_pub),'confirm'=>'Are you sure you want to delete this item?'), 
					   'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
		array('label'=>'Publication Directory', 'url'=>array('index')),
		array('label'=>'Upload a Publication', 'url'=>array('create'), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
		array('label'=>'Search a Publication', 'url'=>array('search')),
);

$authors = array();
foreach($model->authors as $author){
	array_push($authors, $author->getDisplayName());
}

$keywords = array();
foreach($model->keywords as $keyword){
	array_push($keywords, '<a href="'.$this->createUrl('publication/searchByKeyword', array('keyword'=>$keyword->key_pub_keyword)).'">'.$keyword->fld_keyword.'</a>');
}
$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
					'fld_pub_title',
					array(
						'label'=>'Authors',
						'value'=>implode(', ', $authors),
						'visible'=>Yii::app()->user->isGuest || Yii::app()->user->name=='demo'
					),
					'fld_txt_page',
					'fld_no_page',
					array(
						'name'=>'key_dept',
						'value'=>$model->department->fld_name
					),
					array(
						'name'=>'fld_date_stored',
						'value'=>$model->assembleHumanReadableDate($model->fld_date_stored),
						'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')
					),
					array(
						'name'=>'fld_is_visible',
						'value'=>$model->getVisibilityDescription($model->fld_is_visible),
						'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')
					),
					array(
						'label'=>'Keywords',
						'type'=>'raw',
						'value'=>implode(', ', $keywords),
						'visible'=>Yii::app()->user->isGuest || Yii::app()->user->name=='demo'
					)
			),
	));
?>