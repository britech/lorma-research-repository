<?php

/**
 * This is the model class for table "tbl_pub_author".
 *
 * The followings are the available columns in table 'tbl_pub_author':
 * @property integer $key_author
 * @property string $fld_lname
 * @property string $fld_fname
 * @property string $fld_mname
 * @property integer $key_dept
 * @property integer $key_pub
 * @property string $fld_designation
 *
 * The followings are the available model relations:
 * @property Department $department
 * @property Publication $publication
 */
class Author extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_pub_author';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fld_lname, fld_fname, fld_mname, key_dept, key_pub, fld_designation', 'required'),
			array('key_dept, key_pub', 'numerical', 'integerOnly'=>true),
			array('fld_lname, fld_fname, fld_mname', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('key_author, fld_lname, fld_fname, fld_mname, key_dept, key_pub, fld_designation', 'safe', 'on'=>'search'),
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
			'department' => array(self::BELONGS_TO, 'Department', 'key_dept'),
			'publication' => array(self::BELONGS_TO, 'Publication', 'key_pub'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'key_author' => 'Author ID',
			'fld_lname' => 'Surname',
			'fld_fname' => 'Given Name',
			'fld_mname' => 'Middle Name/Initial',
			'key_dept' => 'Department Assigned',
			'key_pub' => 'Publication',
			'fld_designation' => 'Designation',
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

		$criteria->compare('key_author',$this->key_author);
		$criteria->compare('fld_lname',$this->fld_lname,true);
		$criteria->compare('fld_fname',$this->fld_fname,true);
		$criteria->compare('fld_mname',$this->fld_mname,true);
		$criteria->compare('key_dept',$this->key_dept);
		$criteria->compare('key_pub',$this->key_pub);
		$criteria->compare('fld_designation',$this->fld_designation,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Author the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
