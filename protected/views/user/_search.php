<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'key_user'); ?>
		<?php echo $form->textField($model,'key_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_name'); ?>
		<?php echo $form->textArea($model,'fld_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_username'); ?>
		<?php echo $form->textField($model,'fld_username',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_email_address'); ?>
		<?php echo $form->textArea($model,'fld_email_address',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_restrictions'); ?>
		<?php echo $form->textField($model,'fld_restrictions',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_user_stat'); ?>
		<?php echo $form->textField($model,'fld_user_stat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->