<?php

/**
 * This is the model class for table "tbl_library".
 *
 * The followings are the available columns in table 'tbl_library':
 * @property string $key_library
 * @property integer $key_pub
 * @property integer $key_user
 *
 * The followings are the available model relations:
 * @property TblPub $keyPub
 * @property TblUser $keyUser
 */
class TaggedPublication extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_library';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key_pub, key_user', 'required'),
			array('key_pub, key_user', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('key_library, key_pub, key_user', 'safe', 'on'=>'search'),
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
			'keyPub' => array(self::BELONGS_TO, 'TblPub', 'key_pub'),
			'keyUser' => array(self::BELONGS_TO, 'TblUser', 'key_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'key_library' => 'Key Library',
			'key_pub' => 'Key Pub',
			'key_user' => 'Key User',
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

		$criteria->compare('key_library',$this->key_library,true);
		$criteria->compare('key_pub',$this->key_pub);
		$criteria->compare('key_user',$this->key_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TaggedPublication the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
