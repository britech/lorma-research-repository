<?php
/* @var $this KeywordController */
/* @var $data Keyword */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_pub_keyword')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->key_pub_keyword), array('view', 'id'=>$data->key_pub_keyword)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keyword')); ?>:</b>
	<?php echo CHtml::encode($data->keyword); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_pub')); ?>:</b>
	<?php echo CHtml::encode($data->key_pub); ?>
	<br />


</div>