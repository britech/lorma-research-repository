<?php
//TODO put title here
$this->breadcrumbs=array(
	'Publications'=>array('index'),
	'Publication Information'=>array('publication/view', 'id'=>$formModel->key_pub),
	'Files'
);

$this->profileLink=array(
		array('label'=>'Authors', 'url'=>array('publication/author', 'publication'=>$formModel->key_pub), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
		array('label'=>'Folders', 'url'=>array('publication/folder', 'publication'=>$formModel->key_pub), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
		array('label'=>'Files', 'url'=>array('publication/file', 'publication'=>$formModel->key_pub)),
		array('label'=>'Keywords', 'url'=>array('publication/keyword', 'publication'=>$formModel->key_pub), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
		array('label'=>'Download All Files', 'url'=>array('publication/downloadAllFiles', 'id'=>$formModel->key_pub), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='admin'))
);

$this->menu=array(
		array('label'=>'Update Publication', 'url'=>array('update', 'id'=>$formModel->key_pub), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
		array('label'=>'Delete Publication', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$formModel->key_pub),'confirm'=>'Are you sure you want to delete this item?'),
			  'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
		array('label'=>'Publication Directory', 'url'=>array('index')),
		array('label'=>'Upload a Publication', 'url'=>array('create'), 'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')),
		array('label'=>'Search a Publication', 'url'=>array('search')),
);?>
<h1>Files</h1>

<?php if(!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')):?>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'file-form',
		'action'=>$formModel->isNewRecord ? array('publication/file', 'publication'=>$formModel->key_pub) : array('publication/updateFile', 'id'=>$formModel->key_pub_file),
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

	<?php if($formModel->isNewRecord):?>
	<div class="row">
		<?php echo $form->labelEx($formModel,'fld_filename'); ?>
		<?php echo $form->fileField($formModel,'fld_filename'); ?>
		<?php echo $form->error($formModel,'fld_filename'); ?>		
	</div>
	<?php endif;?>
	
	<div class="row">
		<?php echo $form->labelEx($formModel,'fld_dload_restriction'); ?>
		<?php echo $form->dropDownList($formModel,'fld_dload_restriction',File::getDownloadRestrictionTypes()); ?>
		<?php echo $form->error($formModel,'fld_dload_restriction'); ?>
		<?php echo $form->hiddenField($formModel,'key_pub');?>
		<?php if(!$formModel->isNewRecord){ echo $form->hiddenField($formModel, 'key_pub_file');}?>
	</div>

	<div class="row buttons">
		<?php echo $formModel->isNewRecord ? CHtml::submitButton('Enlist', array('class'=>'button green')) : CHtml::submitButton('Update', array('class'=>'button blue')); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>
<?php 
endif;

$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'file-grid',
		'dataProvider'=>$gridModel->search($formModel->key_pub),
		'columns'=>array(
				array(
					'name'=>'fld_file_title',
					'htmlOptions'=>array('style'=>'width:30%'),
					'sortable'=>false
				),
				array(
					'name'=>'key_folder_group',
					'value'=>'$data->folder->fld_group_name',
					'sortable'=>false
				),
				array(
					'name'=>'fld_file_position',
					'htmlOptions'=>array('style'=>'text-align:center; width: 10%;'),
					'sortable'=>false,
					'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')
				),
				array(
					'name'=>'fld_dload_restriction',
					'value'=>'File::getDownloadRestrictionDescription($data->fld_dload_restriction)',
					'sortable'=>false,
					'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')
				),
				array(
					'class'=>'CButtonColumn',
					'viewButtonUrl'=>'array("publication/downloadFile/","id"=>$data->key_pub_file)',
					'viewButtonImageUrl'=>'../themes/shadow_dancer/images/small_icons/page_white_put.png',
					'viewButtonOptions'=>array('title'=>'Download'),
					'updateButtonUrl'=>'array("publication/updateFile", "id"=>$data->key_pub_file)',
					'deleteButtonUrl'=>'array("publication/deleteFile", "id"=>$data->key_pub_file)',
					'afterDelete'=>'function(link,success,data){if(success) window.location=window.location}',
					'visible'=>!(Yii::app()->user->isGuest || Yii::app()->user->name=='demo')
				),
				array(
					'class'=>'CButtonColumn',
					'template'=>'{view}',
					'viewButtonUrl'=>'array("publication/downloadFile/","id"=>$data->key_pub_file)',
					'viewButtonImageUrl'=>'../themes/shadow_dancer/images/small_icons/page_white_put.png',
					'viewButtonOptions'=>array('title'=>'Download'),
					'visible'=>Yii::app()->user->isGuest || Yii::app()->user->name=='demo'
				),
		),
		'summaryText'=>''
));
?>