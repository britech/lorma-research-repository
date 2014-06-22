<?php
/* @var $this PublicationController */
/* @var $model Publication */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'publication-initial-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_pub_title'); ?>
		<?php echo $form->textArea($model,'fld_pub_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fld_pub_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_txt_page'); ?>
		<?php echo $form->textField($model,'fld_txt_page'); ?>
		<?php echo $form->error($model,'fld_txt_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_no_page'); ?>
		<?php echo $form->textField($model,'fld_no_page'); ?>
		<?php echo $form->error($model,'fld_no_page'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'fld_location'); ?>
		<?php echo $form->textArea($model,'fld_location',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fld_location'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'key_dept'); ?>
		<?php echo $form->dropDownList($model,'key_dept',$deptList); ?>
		<?php echo $form->error($model,'key_dept'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_date_stored'); ?>
		<?php /* echo $form->textField($model,'fld_date_stored'); */ 
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'Publication[fld_date_stored]',
				'options'=>array(
					'showAnim'=>'blind',
					'changeMonth'=>true,
					'changeYear'=>true,
					'yearRange'=>(1973-date('Y')).":+".(2100-date('Y'))
				),
				'htmlOptions'=>array(
					'class'=>'shadowdatepicker'
				),
		));
		?>
		<?php echo $form->error($model,'fld_date_stored'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'fld_format_type'); ?>
		<?php echo $form->textField($model,'fld_format_type',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fld_format_type'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'fld_is_visible'); ?>
		<?php echo $form->dropDownList($model,'fld_is_visible',$model->getVisibilityList()); ?>
		<?php echo $form->error($model,'fld_is_visible'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->