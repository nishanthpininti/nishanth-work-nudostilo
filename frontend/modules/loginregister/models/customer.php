<?php

namespace frontend\modules\loginregister\models;

use yii\db\ActiveRecord;
use yii\web\Session;
use frontend\modules\loginregister\models\Profile;
use frontend\modules\loginregister\models\Endorsement;

class customer extends ActiveRecord{
	
	public $password;
    public $confirmPassword;
	
	
	public function rules(){
		return [
				['customer_user_name','filter','filter' => 'trim' ,'on'=>'register'],
				['customer_user_name','required','on'=>'register'],
				['customer_user_name','unique','targetClass'=>'frontend\modules\loginregister\models\user_login','targetAttribute'=>'user_name','on'=>'register'],
				['customer_user_name','safe','on'=>'insert'],
				
				['customer_first_name','trim','on'=>'register'],
				['customer_first_name','required','on'=>'register'],
				['customer_first_name','safe','on'=>'insert'],
				
				['customer_last_name','trim','on'=>'register'],
				['customer_last_name','required','on'=>'register'],
				['customer_last_name','safe','on'=>'insert'],
				
				['customer_email', 'trim','on'=>'register'],
				['customer_email', 'required','on'=>'register'],
				['customer_email', 'unique','on'=>'register'],
				['customer_email','safe','on'=>'insert'],
				
				['customer_gender', 'required','on'=>'register'],
				['customer_gender','safe','on'=>'insert'],
				
				['customer_birthdate', 'required','on'=>'register'],
				['customer_birthdate','safe','on'=>'insert'],
				
				['customer_address1','safe','on'=>'register'],
				['customer_address1','safe','on'=>'insert'],
				['customer_address2','safe','on'=>'register'],
				['customer_address2','safe','on'=>'insert'],
				
				['customer_from','safe','on'=>'register'],
				['customer_from','safe','on'=>'insert'],
				
				['customer_favcolor','safe','on'=>'register'],
				['customer_favcolor','safe','on'=>'insert'],
				
				['password', 'required','on'=>'register'],
				['password', 'safe','on'=>'insert'],
				['confirmPassword', 'required','on'=>'register'],
				['confirmPassword', 'safe','on'=>'insert'],
				['password', 'compare', 'compareAttribute' => 'confirmPassword','on'=>'register']
			];
	}
	
	public function customerAndUserInsert(){
		$user = new user_login();
		$user->user_name = $this->customer_user_name;
		$user->user_password = $this->password;
		$user->user_type = 'c';
		$user->save();
		$this->setScenario('insert');
		if ($this->save())
		{
			$profile = (new Profile)->createProfile($this->customer_user_name,'Dummy/Path');
			$endorse = (new Endorsement)->createEndorsement($this->customer_user_name);
			return true;
		}
		else {
			$user->delete();
			return false;
		}
	}
	
	public function insertCustomerOnLogin()
	{
		$session = new Session;
		$session->open();
		$this->customer_user_name = $session['email'];
		$this->customer_first_name = $session['fname'];
		$this->customer_last_name = $session['lname'];
		$this->customer_email = $session['email'];
		if($session['gender'] == 'male')
		{
			$this->customer_gender = 'M';
			$this->insert();
	    }
		else
		{
			$this->customer_gender = 'F';
			$this->insert();
		}
		return true;
	}
}