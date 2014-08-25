<h1>Search a Publication</h1>
<div class="wide form">
	<?php $form=$this->beginWidget('CActiveForm', array()); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'publicationTitle'); ?>
		<?php echo $form->textField($model,'publicationTitle', array('size'=>125)); ?>
		<?php echo $form->error($model,'publicationTitle'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'departmentOfOrigin'); ?>
		<?php echo $form->dropDownList($model,'departmentOfOrigin', $deptList); ?>
		<?php echo $form->error($model,'departmentOfOrigin'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'authorLastNames'); ?>
		<span style="display:inline-block;">
		<?php $this->widget('ext.tokeninput.TokenInput', array(
			'model'=>$model,
			'attribute'=>'authorLastNames',
			'url'=>array('searchAuthors'),
			'options'=>array(
				'method'=>'POST',
				'queryParam'=>'lastName',
				'animateDropdown'=>false,
				'tokenDelimiter'=>',',
				'preventDuplicates'=>true,
			)
		));?>
		</span>
		<?php echo $form->error($model,'authorLastNames'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'keywords'); ?>
		<span style="display:inline-block;">
			<?php $this->widget('ext.tokeninput.TokenInput', array(
				'model'=>$model,
				'attribute'=>'keywords',
				'url'=>array('searchKeywords'),
				'options'=>array(
					'method'=>'POST',
					'queryParam'=>'keyword',
					'animateDropdown'=>false,
					'tokenDelimiter'=>',',
					'preventDuplicates'=>true,
				)
			));?>
		</span>
		<?php echo $form->error($model,'keywords'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'limit'); ?>
		<?php echo $form->dropDownList($model, 'limit', $model->getPaginationSizes()); ?>
		<?php echo $form->error($model,'limit'); ?>
	</div>
	<div class="row buttons">
		<?php 
		$input = filter_input(INPUT_POST, "SearchCriteria");
		
		echo CHtml::submitButton('Search', array('class'=>'button green')); 
		
		if(isset($input)){
			echo CHtml::link('Restart Search', array('search'));
		}?>
	</div>
	<?php $this->endWidget(); ?>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name'=>'fld_pub_title',
			'sortable'=>false
		),
		array(
			'name'=>'key_dept',
			'value'=>'$data->department->fld_name',
			'sortable'=>false
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>