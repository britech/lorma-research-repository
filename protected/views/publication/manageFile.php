<?php
//TODO put title here
$this->breadcrumbs=array(
	'Publications'=>array('index'),
	'Publication Information'=>array('publication/view', 'id'=>$formModel->key_pub),
	'Authors'
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
);?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'file-form',
	//'action'=>array('publication/insertFile', 'publication'=>$model->key_pub),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($formModel); ?>

	<div class="row">
		<?php echo $form->labelEx($formModel,'fld_file_title'); ?>
		<?php echo $form->textField($formModel,'fld_file_title',array('size'=>100)); ?>
		<?php echo $form->error($formModel,'fld_file_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($formModel,'key_folder_group'); ?>
		<?php echo $form->dropDownList($formModel,'key_folder_group',$folderList); ?>
		<?php echo $form->error($formModel,'key_folder_group'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($formModel,'fld_file_position'); ?>
		<?php echo $form->textField($formModel,'fld_file_position'); ?>
		<?php echo $form->error($formModel,'fld_file_position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($formModel,'fld_filename'); ?>
		<?php echo $form->fileField($formModel,'fld_filename'); ?>
		<?php echo $form->error($formModel,'fld_filename'); ?>		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($formModel,'fld_dload_restriction'); ?>
		<?php echo $form->dropDownList($formModel,'fld_dload_restriction',File::getDownloadRestrictionTypes()); ?>
		<?php echo $form->error($formModel,'fld_dload_restriction'); ?>
		<?php echo $form->hiddenField($formModel,'key_pub');?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($formModel->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'file-grid',
		'dataProvider'=>$gridModel->search($model->key_pub),
		'columns'=>array(
				'fld_file_title',
				array(
					'name'=>'key_folder_group',
					'value'=>'$data->folder->fld_group_name',
				),
				array(
					'name'=>'fld_dload_restriction',
					'value'=>'File::getDownloadRestrictionDescription($data->fld_dload_restriction)'
				),
				array(
					'class'=>'CButtonColumn',
					'viewButtonUrl'=>'array("publication/downloadFile/","id"=>$data->key_pub_file)',
					'viewButtonImageUrl'=>'../themes/shadow_dancer/images/small_icons/page_white_put.png',
					'viewButtonOptions'=>array('title'=>'Download'),
					'updateButtonUrl'=>'array("publication/updateFile", "id"=>$data->key_pub_file)',
					'deleteButtonUrl'=>'array("publication/deleteFile", "id"=>$data->key_pub_file)'
				),
		),
));
?>