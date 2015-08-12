<?php

namespace frontend\modules\loginregister\models;

use yii\db\ActiveRecord;

class user_login extends ActiveRecord{

public function addUser($username)
{
		//$usersociallogin = new user_login();
		$this->user_name = $username;
		$this->user_password = 'FBLogin_dummy';
		$this->user_type = 'c';
		$this->insert();
		return true;
}

public function userAlreadyExists($username)
{
	return user_login::findBySql('select * from user_login where user_name ="'.$username.'"')->all();
}

public function getUserType($username)
	{
		$userType = user_login::find('user_type')->where(['user_name' => $username])->one();
		return $userType->user_type;
	}

}