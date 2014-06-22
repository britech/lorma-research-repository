<?php
$this->pageTitle=Yii::app()->name . ' - Register';
$this->breadcrumbs=array(
	'Register',
);
?>

<h1>Register</h1>

<?php if(Yii::app()->user->hasFlash('register')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('register'); ?>
</div>

<?php else: ?>

<div class="flash-notice">
	To enjoy the full privileges of viewing and downloading our research materials, please register here. No worries! Registration is FREE.
</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'signup-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName', array('size'=>50)); ?>
		<?php echo $form->error($model,'firstName'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'midName'); ?>
		<?php echo $form->textField($model,'midName', array('size'=>50)); ?>
		<?php echo $form->error($model,'midName'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'lastName'); ?>
		<?php echo $form->textField($model,'lastName', array('size'=>50)); ?>
		<?php echo $form->error($model,'lastName'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fld_email_address'); ?>
		<?php echo $form->textField($model,'fld_email_address', array('size'=>50)); ?>
		<?php echo $form->error($model,'fld_email_address'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fld_username'); ?>
		<?php echo $form->textField($model,'fld_username'); ?>
		<?php echo $form->error($model,'fld_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_password'); ?>
		<?php echo $form->passwordField($model,'fld_password'); ?>
		<?php echo $form->error($model,'fld_password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'checkPassword'); ?>
		<?php echo $form->passwordField($model,'checkPassword'); ?>
		<?php echo $form->error($model,'checkPassword'); ?>
		<?php echo $form->hiddenField($model, 'fld_restrictions')?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Register', array('class'=>'button blue')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif;?>
