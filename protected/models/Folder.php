<?php

/**
 * This is the model class for table "tbl_folder_group".
 *
 * The followings are the available columns in table 'tbl_folder_group':
 * @property integer $key_folder_group
 * @property string $fld_group_name
 * @property string $fld_description
 * @property integer $fld_order
 *
 * The followings are the available model relations:
 * @property File[] $files
 */
class Folder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_folder_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fld_group_name, fld_order', 'required'),
			array('fld_description', 'safe'),
			array('fld_order', 'numerical', 'integerOnly'=>true, 'min'=>1, 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('key_folder_group, fld_group_name, fld_description', 'safe', 'on'=>'search'),
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
			'files' => array(self::HAS_MANY, 'File', 'key_folder_group'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'key_folder_group' => 'Folder ID',
			'fld_group_name' => 'Folder Group Name',
			'fld_description' => 'Description',
			'fld_order'=>'Folder Order'
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

		$criteria->compare('key_folder_group',$this->key_folder_group);
		$criteria->compare('fld_group_name',$this->fld_group_name,true);
		$criteria->compare('fld_description',$this->fld_description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Folder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
