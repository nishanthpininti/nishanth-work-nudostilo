<?php

namespace frontend\modules\loginregister\models;

use yii\db\ActiveRecord;

class investor extends ActiveRecord{
	
	public $password;
	public $confirmPassword;
	
public function rules(){
		return [
				['investor_user_name','filter','filter' => 'trim' ,'on'=>'register'],
				['investor_user_name','required','on'=>'register'],
				['investor_user_name','unique','targetClass'=>'frontend\modules\loginregister\models\user_login','targetAttribute'=>'user_name','on'=>'register'],
				['investor_user_name','safe','on'=>'insert'],
				
				['investor_first_name','trim','on'=>'register'],
				['investor_first_name','required','on'=>'register'],
				['investor_first_name','safe','on'=>'insert'],
				
				['investor_last_name','trim','on'=>'register'],
				['investor_last_name','required','on'=>'register'],
				['investor_last_name','safe','on'=>'insert'],
				
				['investor_email', 'trim','on'=>'register'],
				['investor_email', 'required','on'=>'register'],
				['investor_email', 'unique','on'=>'register'],
				['investor_email','safe','on'=>'insert'],
				
				['investor_gender', 'required','on'=>'register'],
				['investor_gender','safe','on'=>'insert'],
				
				
				['investor_address1','safe','on'=>'register'],
				['investor_address1','safe','on'=>'insert'],
				['investor_address2','safe','on'=>'register'],
				['investor_address2','safe','on'=>'insert'],
				
				
				['password', 'required','on'=>'register'],
				['password', 'safe','on'=>'insert'],
				['confirmPassword', 'required','on'=>'register'],
				['confirmPassword', 'safe','on'=>'insert'],
				['password', 'compare', 'compareAttribute' => 'confirmPassword','on'=>'register']
			];
	}
	
	public function investorAndUserInsert(){
		$user = new user_login();
		$user->user_name = $this->investor_user_name;
		$user->user_password = $this->password;
		$user->user_type = 'i';
		$user->save();
		$this->setScenario('insert');
		if ($this->save()){
			return true;
		}
		else {
			$user->delete();
			return false;
		}
	}
}