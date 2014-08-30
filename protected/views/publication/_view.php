<?php
/* @var $this PublicationController */
/* @var $data Publication */

$keywords = array();
foreach($data->keywords as $keyword){
	array_push($keywords, '<a href="'.$this->createUrl('publication/searchByKeyword', array('keyword'=>$keyword->fld_keyword)).'">'.$keyword->fld_keyword.'</a>');
}

$displayKeywords = implode(', ', $keywords);
?>

<div class="view">

	<p style="font-weight: bold;">
		<?php echo CHtml::link(CHtml::encode($data->fld_pub_title), array('view', 'id'=>$data->key_pub)); ?>
	</p>

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_dept')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->department->fld_name), array('publication/searchByDepartment', 'department'=>$data->key_dept)); ?>
	<br />
	
	<b>Keywords:</b>
	<?php echo $displayKeywords==null ? "No keywords defined" : $displayKeywords; ?>
	<br />
	
</div>