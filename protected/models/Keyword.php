<?php

/**
 * This is the model class for table "tbl_pub_keyword".
 *
 * The followings are the available columns in table 'tbl_pub_keyword':
 * @property integer $key_pub_keyword
 * @property string $keyword
 * @property integer $key_pub
 *
 * The followings are the available model relations:
 * @property TblPub $keyPub
 */
class Keyword extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_pub_keyword';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('keyword, key_pub', 'required'),
			array('key_pub', 'numerical', 'integerOnly'=>true),
			array('keyword', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('key_pub_keyword, keyword, key_pub', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'key_pub_keyword' => 'Key Pub Keyword',
			'keyword' => 'Keyword',
			'key_pub' => 'Key Pub',
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

		$criteria->compare('key_pub_keyword',$this->key_pub_keyword);
		$criteria->compare('keyword',$this->keyword,true);
		$criteria->compare('key_pub',$this->key_pub);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Keyword the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
