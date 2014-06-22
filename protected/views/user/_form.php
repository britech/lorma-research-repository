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
		<?php echo $form->labelEx($model, 'firstName'); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>50)); ?>
		<?php echo $form->error($model,'firstName'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'midName'); ?>
		<?php echo $form->textField($model,'midName',array('size'=>50)); ?>
		<?php echo $form->error($model,'midName'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'lastName'); ?>
		<?php echo $form->textField($model,'lastName',array('size'=>50)); ?>
		<?php echo $form->error($model,'lastName'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fld_username'); ?>
		<?php echo $form->textField($model,'fld_username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fld_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_password'); ?>
		<?php echo $form->passwordField($model,'fld_password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fld_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_email_address'); ?>
		<?php echo $form->textField($model,'fld_email_address',array('size'=>100)); ?>
		<?php echo $form->error($model,'fld_email_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_restrictions'); ?>
		<?php echo $form->dropDownList($model,'fld_restrictions', $model->getRestrictionList()); ?>
		<?php echo $form->error($model,'fld_restrictions'); ?>
	</div>
	
	<?php if($model->isNewRecord):?>
		<?php echo $form->hiddenField($model, 'fld_user_stat');?>
	<?php else:?>
	<div class="row">
		<?php echo $form->labelEx($model,'fld_user_stat'); ?>
		<?php echo $form->dropDownList($model,'fld_user_stat',$model->getStatusList()); ?>
		<?php echo $form->error($model,'fld_user_stat'); ?>
	</div>
	<?php endif;?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->