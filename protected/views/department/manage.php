<?php
/* @var $this DepartmentController */

$this->pageTitle = Yii::app()->name.' - Manage Departments';

if($model->isNewRecord){
	$this->breadcrumbs=array(
			'Departments',
	);
} else{
	$this->breadcrumbs=array(
			'Departments'=>array('index'),
			'Department Info'=>array('view', 'id'=>$model->key_dept),
			'Update Department Info'
	);
}
if(!empty($model->key_dept)){
	$this->menu=array(
			array('label'=>'Enlist a Department', 'url'=>array('index')),
			array('label'=>'Department Info', 'url'=>array('view', 'id'=>$model->key_dept)),
	);
}
?>

<h1>Departments</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'department-form',
	'action'=>array('department/create'),
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
		<?php echo $form->labelEx($model,'fld_code'); ?>
		<?php echo $form->textField($model,'fld_code',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fld_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_name'); ?>
		<?php echo $form->textField($model,'fld_name',array('size'=>50)); ?>
		<?php echo $form->error($model,'fld_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo $model->isNewRecord ? CHtml::submitButton('Enlist', array('class'=>'button green')) : CHtml::submitButton('Save', array('class'=>'button blue')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'department-grid',
	'dataProvider'=>$gridModel->search(),
	'filter'=>$gridModel,
	'columns'=>array(
		'fld_code',
		'fld_name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
