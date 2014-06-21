<?php
$this->pageTitle=Yii::app()->name . ' - Register';
$this->breadcrumbs=array(
	'Register',
);
?>

<h1>Register</h1>
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
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Don't have an account? <a href="<?php echo $this->createUrl('site/register');?>">Sign up here</a>.
		</p>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Login', array('class'=>'button green')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
