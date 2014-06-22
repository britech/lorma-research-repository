<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $key_user
 * @property string $fld_name
 * @property string $fld_username
 * @property string $fld_password
 * @property string $fld_email_address
 * @property string $fld_restrictions
 * @property integer $fld_user_stat
 *
 * The followings are the available model relations:
 * @property TaggedPublication[] $tags
 * @property Note[] $notes
 */
class User extends CActiveRecord
{
	
	const RESTRICTION_ADMINISTRATOR = "ADMIN";
	const RESTRICTION_REGULAR = "BASIC";
	public function getRestrictionList(){
		return array(self::RESTRICTION_ADMINISTRATOR=>'Administrative',
					 self::RESTRICTION_REGULAR=>'Basic');
	}
	public function getRestrictionDescription($restriction){
		return $this->getRestrictionList()[$restriction];
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fld_name, fld_username, fld_password, fld_email_address', 'required'),
			array('fld_email_address', 'email'),
			array('firstName, lastName, midName, fld_username, fld_password, checkPassword, fld_email_address', 'required', 'on'=>'register'),
			array('fld_username', 'unique'),
			array('fld_username', 'length', 'min'=>8),
			array('fld_password', 'length', 'min'=>5),
			array('firstName, lastName, midName', 'length','min'=>1),
			array('fld_user_stat', 'numerical', 'integerOnly'=>true),
			array('fld_username, fld_password, fld_restrictions', 'length', 'max'=>50),
			array('checkPassword', 'compare', 'compareAttribute'=>'fld_password', 'on'=>'register'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('key_user, fld_name, fld_username, fld_password, fld_email_address, fld_restrictions', 'safe', 'on'=>'search'),
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
			'tags' => array(self::HAS_MANY, 'TaggedPublication', 'key_user'),
			'notes' => array(self::HAS_MANY, 'Note', 'key_user'),
		);
	}

	public $firstName="";
	public $lastName="";
	public $midName="";
	public $checkPassword="";
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'key_user' => 'User ID',
			'fld_name' => 'Name',
			'fld_username' => 'Username',
			'fld_password' => 'Password',
			'fld_email_address' => 'Email Address',
			'fld_restrictions' => 'Account Restrictions',
			'fld_user_stat' => 'Account Status',
				
			'firstName'=>'Given Name',
			'lastName'=>'Surname',
			'midName'=>'Middle Name/Initial',
			'checkPassword'=>'Confirm Password'
		);
	}
	
	public function assembleName(){
		return strtoupper($this->firstName." ".substr($this->midName, 0, 1).". ".$this->lastName);
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

		$criteria->compare('key_user',$this->key_user);
		$criteria->compare('fld_name',$this->fld_name,true);
		$criteria->compare('fld_username',$this->fld_username,true);
		$criteria->compare('fld_password',$this->fld_password,true);
		$criteria->compare('fld_email_address',$this->fld_email_address,true);
		$criteria->compare('fld_restrictions',$this->fld_restrictions,true);
		//$criteria->compare('fld_user_stat',$this->fld_user_stat);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
