<?php

/**
 * This is the model class for table "tbl_pub_file".
 *
 * The followings are the available columns in table 'tbl_pub_file':
 * @property string $key_pub_file
 * @property string $fld_file_title
 * @property integer $key_folder_group
 * @property integer $fld_file_position
 * @property integer $key_pub
 * @property string $fld_dload_restriction
 * @property string $fld_filename
 *
 * The followings are the available model relations:
 * @property Folder $folder
 * @property Publication $publication
 */
class File extends CActiveRecord
{
	
	const RESTRICTION_DLOAD_UNAUTH="A";
	const RESTRICTION_DLOAD_IDENTITY="I";
	const RESTRICTION_DLOAD_PRIVATE="P";
	
	public static function getDownloadRestrictionTypes(){
		return array(self::RESTRICTION_DLOAD_UNAUTH=>'Everyone',
					 self::RESTRICTION_DLOAD_IDENTITY=>'Require user credential',
					 self::RESTRICTION_DLOAD_PRIVATE=>'Downloadable only by RnD Staff');
	}
	
	public static function getDownloadRestrictionDescription($index){
		if(array_key_exists($index, self::getDownloadRestrictionTypes())){
			return self::getDownloadRestrictionTypes()[$index];
		} else{
			return "Unknown";
		}
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_pub_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fld_file_title, key_folder_group, fld_file_position, key_pub, fld_dload_restriction', 'required'),
			array('key_folder_group, fld_file_position, key_pub', 'numerical', 'integerOnly'=>true, 'min'=>1),
			array('fld_dload_restriction', 'length', 'max'=>5),
			array('fld_filename','file','types'=>array('doc','docx','pdf','xls','xlsx')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('key_pub_file, fld_file_title, key_folder_group, fld_file_position, fld_no_pages, key_pub, fld_dload_restriction', 'safe', 'on'=>'search'),
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
			'folder' => array(self::BELONGS_TO, 'Folder', 'key_folder_group'),
			'publication' => array(self::BELONGS_TO, 'Publication', 'key_pub'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'key_pub_file' => 'File ID',
			'fld_file_title' => 'Title/Description',
			'key_folder_group' => 'Assigned Folder',
			'fld_file_position' => 'File Order in Folder',
			'fld_filename' => 'Filename',
			'key_pub' => 'Publication Assigned',
			'fld_dload_restriction' => 'Download Restriction',
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
	public function search($publication)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->compare('key_pub_file',$this->key_pub_file,true);
		//$criteria->compare('fld_file_title',$this->fld_file_title,true);
		//$criteria->compare('key_folder_group',$this->key_folder_group);
		//$criteria->compare('fld_file_position',$this->fld_file_position);
		//$criteria->compare('fld_no_pages',$this->fld_no_pages);
		//$criteria->compare('key_pub',$this->key_pub);
		//$criteria->compare('fld_dload_restriction',$this->fld_dload_restriction,true);
		$criteria->with=array('folder');
		$criteria->condition="key_pub=:id";
		$criteria->params=array(':id'=>$publication);
		$criteria->order='folder.fld_order ASC, fld_file_position ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return File the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
