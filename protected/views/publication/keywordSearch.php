<?php
$this->breadcrumbs=array(
		'Publications'=>array('index'),
		'Keyword Search'
);
$this->menu=array(
		array('label'=>'Search a Publication', 'url'=>array('search')),
);
$keyword = filter_input(INPUT_GET, "keyword");
?>
<h1>Listing research publications tagged with
	<span style="text-decoration: underline;"><?php echo $keyword;?></span>
</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name'=>'Publication Title',
			'value'=>'$data->publication->fld_pub_title',
			'sortable'=>false
		),
		array(
			'name'=>'Department of Origin',
			'value'=>'$data->publication->department->fld_name',
			'sortable'=>false
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>