<?php

namespace frontend\modules\cart\models;

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
 * @property string $customer_password
 * @property string $customer_ph_number
 *
 * @property BillingInfo[] $billingInfos
 * @property Cart[] $carts
 * @property ItemDetails[] $idetails
 * @property UserLogin $customerUserName
 * @property Friends[] $friends
 * @property Friends[] $friends0
 * @property Order[] $orders
 * @property Profile $profile
 */
class Customer extends \yii\db\ActiveRecord
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
            [['customer_user_name', 'customer_email', 'customer_password'], 'string', 'max' => 45],
            [['customer_first_name'], 'string', 'max' => 50],
            [['customer_last_name'], 'string', 'max' => 80],
            [['customer_address1', 'customer_address2', 'customer_from'], 'string', 'max' => 100],
            [['customer_gender'], 'string', 'max' => 1],
            [['customer_favcolor'], 'string', 'max' => 20],
            [['customer_ph_number'], 'string', 'max' => 10]
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
            'customer_password' => 'Customer Password',
            'customer_ph_number' => 'Customer Ph Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillingInfos()
    {
        return $this->hasMany(BillingInfo::className(), ['customer_usr_name' => 'customer_user_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['customer_user_name' => 'customer_user_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdetails()
    {
        return $this->hasMany(ItemDetails::className(), ['idetails_id' => 'idetails_id'])->viaTable('cart', ['customer_user_name' => 'customer_user_name']);
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
    public function getFriends()
    {
        return $this->hasMany(Friends::className(), ['customer_user_name1' => 'customer_user_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriends0()
    {
        return $this->hasMany(Friends::className(), ['customer_user_name2' => 'customer_user_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_user_name' => 'customer_user_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['customer_user_name' => 'customer_user_name']);
    }
}
