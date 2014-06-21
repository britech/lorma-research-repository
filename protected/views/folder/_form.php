<?php
/* @var $this FolderController */
/* @var $model Folder */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'folder-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_group_name'); ?>
		<?php echo $form->textArea($model,'fld_group_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fld_group_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_description'); ?>
		<?php echo $form->textArea($model,'fld_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fld_description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->