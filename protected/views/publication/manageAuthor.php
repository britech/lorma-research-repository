<?php
//TODO put the page title
$this->breadcrumbs=array(
	'Publications'=>array('index'),
	'Publication Information'=>array('publication/view', 'id'=>$model->key_pub),
	'Authors'
);
$gridModel->key_pub=$model->key_pub;
?>

<?php
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
<h1>Authors</h1>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'author-form',
			'action'=>$model->isNewRecord ? array('publication/enlistAuthor', 'publication'=>$model->key_pub) : array('publication/updateAuthor', 'id'=>$model->key_author),
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
		<?php echo $form->labelEx($model,'fld_fname'); ?>
		<?php echo $form->textField($model,'fld_fname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fld_fname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_mname'); ?>
		<?php echo $form->textField($model,'fld_mname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fld_mname'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fld_lname'); ?>
		<?php echo $form->textField($model,'fld_lname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fld_lname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'key_dept'); ?>
		<?php echo $form->dropDownList($model,'key_dept',$deptList); ?>
		<?php echo $form->error($model,'key_dept'); ?>
		<?php echo $form->hiddenField($model, 'key_pub');?>
		<?php if(!$model->isNewRecord){echo $form->hiddenField($model, 'key_author');}?>
	</div>

	<div class="row buttons">
		<?php echo $model->isNewRecord ? CHtml::submitButton('Create', array('class'=>'button green')) : CHtml::submitButton('Update', array('class'=>'button blue')); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'author-grid',
	'dataProvider'=>$gridModel->search(),
	'columns'=>array(
		array(
			'name'=>'fld_lname',
			'sortable'=>false
		),
		array(
			'name'=>'fld_fname',
			'sortable'=>false
		),
		array(
			'name'=>'fld_mname',
			'sortable'=>false
		),
		array(
			'name'=>'key_dept',
			'value'=>'$data->department->fld_name',
			'sortable'=>false
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'updateButtonUrl'=>'array("publication/updateAuthor", "id"=>$data->key_author)',
			'deleteButtonUrl'=>'array("publication/deleteAuthor", "id"=>$data->key_author)'
		),
	),
)); ?>