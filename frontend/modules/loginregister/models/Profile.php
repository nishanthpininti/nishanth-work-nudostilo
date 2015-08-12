<?php

namespace frontend\modules\loginregister\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property string $customer_user_name
 * @property string $profile_picture
 * @property string $profile_about
 *
 * @property Customer $customerUserName
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'profile_picture', 'profile_about'], 'required'],
            [['profile_picture', 'profile_about'], 'string'],
            [['user_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_name' => 'User Name',
            'profile_picture' => 'Profile Picture',
            'profile_about' => 'Profile About',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserName()
    {
        return $this->hasOne(Customer::className(), ['user_name' => 'customer_user_name']);
    }
	
	public function createProfile($username,$path)
	{
		$this->user_name = $username;
		$this->profile_picture = $path;
		$this->profile_about = 'About Me!';
		$this->insert();
	}
}
