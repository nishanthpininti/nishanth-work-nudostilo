<?php

namespace frontend\models;

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
class ProfileSocialLogin extends \yii\db\ActiveRecord
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
            'user_name' => 'Customer User Name',
            'profile_picture' => 'Profile Picture',
            'profile_about' => 'Profile About',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserName()
    {
        return $this->hasOne(UserLogin::className(), ['user_name' => 'user_name']);
    }
}
