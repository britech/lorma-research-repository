<?php

/**
 * This is the model class for table "tbl_pub".
 *
 * The followings are the available columns in table 'tbl_pub':
 * @property integer $key_pub
 * @property string $fld_pub_title
 * @property integer $fld_txt_page
 * @property integer $fld_no_page
 * @property string $fld_location
 * @property integer $key_dept
 * @property string $fld_date_stored
 * @property string $fld_format_type
 * @property integer $fld_is_visible
 *
 * The followings are the available model relations:
 * @property TaggedPublication[] $taggedPublications
 * @property Department $department
 * @property Author[] $authors
 * @property File[] $files
 * @property Keyword[] $keywords
 * @property Note[] $notes
 */
class Publication extends CActiveRecord
{
	const VISIBILITY_SHOW=1;
	const VISIBILITY_HIDE=0;
	public function getVisibilityList(){
		return array(self::VISIBILITY_SHOW=>'Shown to All',
					 self::VISIBILITY_HIDE=>'Limited Access');
	}
	public function getVisibilityDescription($visibility){
		if($visibility > -1 && $visibility < 2){
			return $this->getVisibilityList()[$visibility];
		} else{
			return "Unknown";
		}
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_pub';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fld_pub_title, fld_txt_page, fld_no_page, key_dept, fld_date_stored', 'required'),
			array('fld_pub_title, fld_txt_page, fld_no_page, key_dept', 'required', 'on'=>'update'),
			array('fld_txt_page, fld_no_page, key_dept, fld_is_visible', 'numerical', 'integerOnly'=>true),
			array('fld_format_type', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('key_pub, fld_pub_title, fld_txt_page, fld_no_page, fld_location, key_dept, fld_date_stored, fld_format_type, fld_is_visible', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'taggedPublication' => array(self::HAS_MANY, 'TaggedPublication', 'key_pub'),
			'department' => array(self::BELONGS_TO, 'Department', 'key_dept'),
			'authors' => array(self::HAS_MANY, 'Author', 'key_pub'),
			'files' => array(self::HAS_MANY, 'File', 'key_pub'),
			'keywords' => array(self::HAS_MANY, 'Keyword', 'key_pub'),
			'notes' => array(self::HAS_MANY, 'Note', 'key_pub'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'key_pub' => 'Publication ID',
			'fld_pub_title' => 'Title',
			'fld_txt_page' => 'Text Number of Pages',
			'fld_no_page' => 'Total Number of Pages',
			'fld_location' => 'Repository Location',
			'key_dept' => 'Department of Origin',
			'fld_date_stored' => 'Date Received to Research Office',
			'fld_format_type' => 'Type of Format Utilized',
			'fld_is_visible' => 'Visibility',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('key_pub',$this->key_pub);
		$criteria->compare('fld_pub_title',$this->fld_pub_title,true);
		$criteria->compare('fld_txt_page',$this->fld_txt_page);
		$criteria->compare('fld_no_page',$this->fld_no_page);
		$criteria->compare('fld_location',$this->fld_location,true);
		$criteria->compare('key_dept',$this->key_dept);
		$criteria->compare('fld_date_stored',$this->fld_date_stored,true);
		$criteria->compare('fld_format_type',$this->fld_format_type,true);
		$criteria->compare('fld_is_visible',$this->fld_is_visible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Publication the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function assembleSqlDate($date){
		$formatDate = explode('/',$date);
		$sqlDate = $formatDate[2]."-".$formatDate[1]."-".$formatDate[0];
		return $sqlDate;
	}
	
	public function assembleHumanReadableDate($date){
		$formatDate = date_create($date);
		return date_format($formatDate, 'F d, Y');
	}
}
