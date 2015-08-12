<?php

namespace frontend\modules\search\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property string $customer_user_name
 * @property string $customer_first_name
 * @property string $customer_last_name
 * @property string $customer_address1
 * @property string $customer_address2
 * @property string $customer_email
 * @property string $customer_gender
 * @property string $customer_from
 * @property string $customer_favcolor
 * @property string $customer_birthdate
 *
 * @property UserLogin $customerUserName
 * @property Profile $profile
 */
class CustomerSocialLogin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_user_name', 'customer_first_name', 'customer_last_name', 'customer_email', 'customer_gender'], 'required'],
            [['customer_birthdate'], 'safe'],
            [['customer_user_name', 'customer_email'], 'string', 'max' => 45],
            [['customer_first_name'], 'string', 'max' => 50],
            [['customer_last_name'], 'string', 'max' => 80],
            [['customer_address1', 'customer_address2', 'customer_from'], 'string', 'max' => 100],
            [['customer_gender'], 'string', 'max' => 1],
            [['customer_favcolor'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_user_name' => 'Customer User Name',
            'customer_first_name' => 'Customer First Name',
            'customer_last_name' => 'Customer Last Name',
            'customer_address1' => 'Customer Address1',
            'customer_address2' => 'Customer Address2',
            'customer_email' => 'Customer Email',
            'customer_gender' => 'Customer Gender',
            'customer_from' => 'Customer From',
            'customer_favcolor' => 'Customer Favcolor',
            'customer_birthdate' => 'Customer Birthdate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserName()
    {
        return $this->hasOne(UserLogin::className(), ['user_name' => 'customer_user_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['customer_user_name' => 'customer_user_name']);
    }
}
