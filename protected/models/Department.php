<?php

/**
 * This is the model class for table "tbl_dept".
 *
 * The followings are the available columns in table 'tbl_dept':
 * @property integer $key_dept
 * @property string $fld_code
 * @property string $fld_name
 *
 * The followings are the available model relations:
 * @property Publication[] $publications
 * @property Author[] $authors
 */
class Department extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_dept';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fld_code, fld_name', 'required'),
			array('fld_code', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('key_dept, fld_code, fld_name', 'safe', 'on'=>'search'),
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
			'publications' => array(self::HAS_MANY, 'Publication', 'key_dept'),
			'authors' => array(self::HAS_MANY, 'Author', 'key_dept'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'key_dept' => 'Department ID',
			'fld_code' => 'Department Code',
			'fld_name' => 'Name',
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

		$criteria->compare('key_dept',$this->key_dept);
		$criteria->compare('fld_code',$this->fld_code,true);
		$criteria->compare('fld_name',$this->fld_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Department the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getDepartmentLabel(){
		return $this->fld_code.' - '.$this->fld_name;
	}
}
