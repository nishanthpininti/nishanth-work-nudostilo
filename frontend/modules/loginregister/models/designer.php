<?php

namespace frontend\modules\loginregister\models;

use yii\db\ActiveRecord;
use frontend\modules\loginregister\models\Profile;
use frontend\modules\loginregister\models\Endorsement;

class designer extends ActiveRecord{
	
	public $password;
	public $confirmPassword;
	
public function rules(){
		return [
				['designer_user_name','filter','filter' => 'trim' ,'on'=>'register'],
				['designer_user_name','required','on'=>'register'],
				['designer_user_name','unique','targetClass'=>'frontend\modules\loginregister\models\user_login','targetAttribute'=>'user_name','on'=>'register'],
				['designer_user_name','safe','on'=>'insert'],
				
				['designer_first_name','trim','on'=>'register'],
				['designer_first_name','required','on'=>'register'],
				['designer_first_name','safe','on'=>'insert'],
				
				['designer_last_name','trim','on'=>'register'],
				['designer_last_name','required','on'=>'register'],
				['designer_last_name','safe','on'=>'insert'],
				
				['designer_email', 'trim','on'=>'register'],
				['designer_email', 'required','on'=>'register'],
				['designer_email', 'unique','on'=>'register'],
				['designer_email','safe','on'=>'insert'],
				
				['designer_gender', 'required','on'=>'register'],
				['designer_gender','safe','on'=>'insert'],
				
				['designer_birthdate', 'required','on'=>'register'],
				['designer_birthdate','safe','on'=>'insert'],
				
				['designer_address1','safe','on'=>'register'],
				['designer_address1','safe','on'=>'insert'],
				['designer_address2','safe','on'=>'register'],
				['designer_address2','safe','on'=>'insert'],
				
				['designer_from','safe','on'=>'register'],
				['designer_from','safe','on'=>'insert'],
				
				['designer_favcolor','safe','on'=>'register'],
				['designer_favcolor','safe','on'=>'insert'],
				
				['password', 'required','on'=>'register'],
				['password', 'safe','on'=>'insert'],
				['confirmPassword', 'required','on'=>'register'],
				['confirmPassword', 'safe','on'=>'insert'],
				['password', 'compare', 'compareAttribute' => 'confirmPassword','on'=>'register']
			];
	}
	
	public function designerAndUserInsert(){
		$user = new user_login();
		$user->user_name = $this->designer_user_name;
		$user->user_password = $this->password;
		$user->user_type = 'd';
		$user->save();
		$this->setScenario('insert');
		if ($this->save())
		{
			$profile = (new Profile)->createProfile($this->designer_user_name,'Dummy/Path');
			$endorse = (new Endorsement)->createEndorsement($this->designer_user_name);
			return true;
		}
		else {
			$user->delete();
			return false;
		}
	}

}