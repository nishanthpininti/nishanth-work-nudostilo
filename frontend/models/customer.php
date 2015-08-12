<?php
namespace  frontend\models;
use yii\db\ActiveRecord;
use yii\base\Model;
use Yii;

class customer extends Model{

public $user_password;
public $confirmPassword;
public $customer_user_name;
public $customer_email;
public $customer_gender;
public $customer_birthdate;
public $customer_first_name;
public $customer_last_name;

public function rules(){
return [
[['customer_user_name','customer_birthdate','customer_gender','customer_email','confirmPassword', 'user_password'], 'required'],
[['confirmPassword'], 'compare', 'compareAttribute' => 'user_password'],
// validates if the value of “password” attribute equals to that of “password_repeat”
['password', 'compare'],
];
}

 public function attributeLabels()
    {
        return [
            'customer_gender' => 'Gender',
            ];
    }

}