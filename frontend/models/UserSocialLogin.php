<?php

namespace frontend\models;

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
class UserSocialLogin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['user_name', 'user_password', 'user_type'], 'required'],
            [['user_name', 'user_password'], 'string', 'max' => 45],
            [['user_type'], 'string', 'max' => 1]
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
	
	public function getUserType($username)
	{
		$userType = UserSocialLogin::find('user_type')->where(['user_name' => $username])->one();
		return $userType->user_type;
	}
}
