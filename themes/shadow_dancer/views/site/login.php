<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<?php if(Yii::app()->user->hasFlash('notif')): ?>
	<div class="flash-notice">
		<?php echo Yii::app()->user->getFlash('notif'); ?>
	</div>
<?php endif;?>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
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
