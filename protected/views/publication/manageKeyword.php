<?php
//TODO put the page title
$this->breadcrumbs=array(
		'Publications'=>array('index'),
		'Publication Information'=>array('publication/view', 'id'=>$model->key_pub),
		'Keywords'
);

$this->profileLink=array(
		array('label'=>'Authors', 'url'=>array('publication/author', 'publication'=>$model->key_pub)),
		array('label'=>'Folders', 'url'=>array('publication/folder', 'publication'=>$model->key_pub)),
		array('label'=>'Files', 'url'=>array('publication/file', 'publication'=>$model->key_pub)),
		array('label'=>'Keywords', 'url'=>array('publication/keyword', 'publication'=>$model->key_pub)),
);

$this->menu=array(
		array('label'=>'Update Publication', 'url'=>array('update', 'id'=>$model->key_pub)),
		array('label'=>'Delete Publication', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->key_pub),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Publication Directory', 'url'=>array('index')),
		array('label'=>'Upload a Publication', 'url'=>array('create')),
		array('label'=>'Search a Publication', 'url'=>array('search')),
);
?>
<h1>Keywords</h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'pub-keyword-form',
		'action'=>$model->isNewRecord ? array('publication/addKeyword', 'publication'=>$model->key_pub) : array('publication/updateKeyword', 'id'=>$model->key_pub_keyword),
		'enableClientValidation'=>true,
		'clientOptions'=>array(
				'validateOnSubmit'=>true,
		),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fld_keyword'); ?>
		<?php echo $form->textField($model,'fld_keyword',array('size'=>100,'maxlength'=>159)); ?>
		<?php echo $form->error($model,'fld_keyword'); ?>
		<?php echo $form->hiddenField($model, 'key_pub');?>
	</div>

	<div class="row buttons">
		<?php echo $model->isNewRecord ? CHtml::submitButton('Add', array('class'=>'button green')) : CHtml::submitButton('Update', array('class'=>'button blue')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'author-grid',
		'dataProvider'=>$gridModel->search($model->key_pub),
		'columns'=>array(
				'fld_keyword',
				array(
					'class'=>'CButtonColumn',
					'template'=>'{update}{delete}',
					'updateButtonUrl'=>'array("publication/updateKeyword", "id"=>$data->key_pub_keyword)',
					'deleteButtonUrl'=>'array("publication/deleteKeyword", "id"=>$data->key_pub_keyword)'
				),
		),
));
?>