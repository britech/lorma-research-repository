<?php
/* @var $this AuthorController */
/* @var $model Author */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'author-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_lname'); ?>
		<?php echo $form->textField($model,'fld_lname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fld_lname'); ?>
	</div>

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
		<?php echo $form->labelEx($model,'key_dept'); ?>
		<?php echo $form->textField($model,'key_dept'); ?>
		<?php echo $form->error($model,'key_dept'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'key_pub'); ?>
		<?php echo $form->textField($model,'key_pub'); ?>
		<?php echo $form->error($model,'key_pub'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_designation'); ?>
		<?php echo $form->textArea($model,'fld_designation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fld_designation'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->