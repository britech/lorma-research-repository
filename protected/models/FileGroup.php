<?php

/**
 * This is the model class for table "tbl_pub_folder".
 *
 * The followings are the available columns in table 'tbl_pub_folder':
 * @property integer $key_pub_folder
 * @property integer $key_pub
 * @property integer $key_folder
 *
 * The followings are the available model relations:
 * @property Publication $publication
 * @property Folder $folder
 */
class FileGroup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_pub_folder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key_pub, key_folder', 'required'),
			array('key_pub, key_folder', 'numerical', 'integerOnly'=>true, 'min'=>1, 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('key_pub_folder, key_pub, key_folder', 'safe', 'on'=>'search'),
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
			'publication' => array(self::BELONGS_TO, 'Publication', 'key_pub'),
			'folder' => array(self::BELONGS_TO, 'Folder', 'key_folder'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'key_pub_folder' => 'FileGroup ID',
			'key_pub' => 'Publication',
			'key_folder' => 'Folder',
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

		$criteria->compare('key_pub_folder',$this->key_pub_folder);
		$criteria->compare('key_pub',$this->key_pub);
		$criteria->compare('key_folder',$this->key_folder);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FileGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
