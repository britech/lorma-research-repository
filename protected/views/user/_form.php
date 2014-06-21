<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_name'); ?>
		<?php echo $form->textArea($model,'fld_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fld_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_username'); ?>
		<?php echo $form->textField($model,'fld_username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fld_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_password'); ?>
		<?php echo $form->textField($model,'fld_password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fld_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_email_address'); ?>
		<?php echo $form->textArea($model,'fld_email_address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fld_email_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_restrictions'); ?>
		<?php echo $form->textField($model,'fld_restrictions',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fld_restrictions'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_user_stat'); ?>
		<?php echo $form->textField($model,'fld_user_stat'); ?>
		<?php echo $form->error($model,'fld_user_stat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->