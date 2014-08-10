<?php
class SearchCriteria extends CFormModel{
	
	public $publicationTitle;
	public $departmentOfOrigin;
	public $authorLastNames;
	public $keywords;
	public $limit = 10;
	
	const SIZE_10 = 10;
	const SIZE_25 = 20;
	const SIZE_50 = 50;
	const SIZE_100 = 100;
	const SIZE_ALL = "*";
	
	public function getPaginationSizes(){
		return array(
				self::SIZE_10=>self::SIZE_10,
				self::SIZE_25=>self::SIZE_25,
				self::SIZE_50=>self::SIZE_50,
				self::SIZE_100=>self::SIZE_100,
				self::SIZE_ALL=>'All Records'
		);
	}
	
	
	public function attributeLabels()
	{
		return array(
			'publicationTitle'=>'Title of Publication',
			'departmentOfOrigin'=>'Department of Origin',
			'authorLastNames'=>'Surname of Authors',
			'keywords'=>'Keywords',
			'limit'=>'Pages to show'
		);
	}
}