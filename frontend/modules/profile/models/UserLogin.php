<?php

namespace frontend\modules\profile\models;

use Yii;

/**
 * This is the model class for table "user_login".
 *
 * @property string $user_name
 * @property string $user_password
 * @property string $user_type
 *
 * @property Customer $customer
 */
class UserLogin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 
	public $confirmPassword;
	public $customer_first_name;
	public $customer_last_name;
	public $customer_email;
	public $customer_gender;
	public $customer_birthdate;
	 
    public static function tableName()
    {
        return 'user_login';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'user_password'], 'required'],
            [['user_name', 'user_password'], 'string', 'max' => 45],
            ['customer_first_name','trim'],
			['customer_first_name','required'],
			['customer_last_name','trim'],
			['customer_last_name','required'],
			['customer_email', 'trim'],
			['customer_email', 'required'],
			['user_name', 'unique'],
			['customer_email', 'trim'],
			['customer_email', 'email'],
			['customer_email', 'required'],
			['customer_gender', 'required'],
			['confirmPassword', 'required'],
			['user_password', 'compare', 'compareAttribute' => 'confirmPassword']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_name' => 'User Name',
            'user_password' => 'User Password',
            'user_type' => 'User Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_user_name' => 'user_name']);
    }
	
	public function getUserLoginData($username)
	{
		$userlogindata = UserLogin::find()->where(['user_name' => $username])->one();
		return $userlogindata;
	}
}
