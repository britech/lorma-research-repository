<?php
class ApplicationUser extends CWebUser{
	public function checkAccess($operation, $params=array()){
		if(empty($this->id)){
			return false;
		}

		$role = Yii::app()->user->role;

		return ($operation === $role);
	}
}
?>