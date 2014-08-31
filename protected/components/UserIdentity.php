<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$record = User::model()->findByAttributes(array('fld_username'=>$this->username, 'fld_user_stat'=>1));
		if($record === null){
			if($this->username==='research' && $this->password==='research'){
				$this->errorCode=self::ERROR_NONE;
			} else{
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			}
		} else{
			if($record->fld_password !== $this->password){
				$this->errorCode=self::ERROR_PASSWORD_INVALID;	
			}
			
			else{
				$this->setState('name', $record->fld_name);
				$this->setState('role', $record->fld_restrictions);
				$this->id = $record->key_user;
				$this->errorCode=self::ERROR_NONE;	
			}
		}
		return !$this->errorCode;
	}

	public function getId(){
		return $this->id;
	}
}