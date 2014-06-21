<?php

/**
 * This is the model class for table "tbl_pub_note".
 *
 * The followings are the available columns in table 'tbl_pub_note':
 * @property string $key_pub_note
 * @property integer $key_user
 * @property integer $key_pub
 * @property string $fld_note_type
 * @property string $fld_note_txt
 * @property string $fld_timestamp
 *
 * The followings are the available model relations:
 * @property TblPub $keyPub
 * @property TblUser $keyUser
 */
class Note extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_pub_note';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key_user, key_pub, fld_note_type, fld_timestamp', 'required'),
			array('key_user, key_pub', 'numerical', 'integerOnly'=>true),
			array('fld_note_type', 'length', 'max'=>5),
			array('fld_note_txt', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('key_pub_note, key_user, key_pub, fld_note_type, fld_note_txt, fld_timestamp', 'safe', 'on'=>'search'),
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
			'key_pub_note' => 'Key Pub Note',
			'key_user' => 'Key User',
			'key_pub' => 'Key Pub',
			'fld_note_type' => 'Fld Note Type',
			'fld_note_txt' => 'Fld Note Txt',
			'fld_timestamp' => 'Fld Timestamp',
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

		$criteria->compare('key_pub_note',$this->key_pub_note,true);
		$criteria->compare('key_user',$this->key_user);
		$criteria->compare('key_pub',$this->key_pub);
		$criteria->compare('fld_note_type',$this->fld_note_type,true);
		$criteria->compare('fld_note_txt',$this->fld_note_txt,true);
		$criteria->compare('fld_timestamp',$this->fld_timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Note the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
