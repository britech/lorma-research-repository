<?php
/* @var $this FileController */
/* @var $model File */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'file-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_file_title'); ?>
		<?php echo $form->textArea($model,'fld_file_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fld_file_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'key_folder_group'); ?>
		<?php echo $form->textField($model,'key_folder_group'); ?>
		<?php echo $form->error($model,'key_folder_group'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_file_position'); ?>
		<?php echo $form->textField($model,'fld_file_position'); ?>
		<?php echo $form->error($model,'fld_file_position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_no_pages'); ?>
		<?php echo $form->textField($model,'fld_no_pages'); ?>
		<?php echo $form->error($model,'fld_no_pages'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'key_pub'); ?>
		<?php echo $form->textField($model,'key_pub'); ?>
		<?php echo $form->error($model,'key_pub'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_dload_restriction'); ?>
		<?php echo $form->textField($model,'fld_dload_restriction',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fld_dload_restriction'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->