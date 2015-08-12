<?php

namespace frontend\modules\cart\models;

use Yii;

/**
 * This is the model class for table "billing_info".
 *
 * @property integer $billing_id
 * @property string $customer_usr_name
 * @property string $billing_address
 * @property string $creditcard_no
 * @property string $creditcard_expdate
 * @property string $name_on_card
 *
 * @property Customer $customerUsrName
 */
class BillingInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'billing_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_usr_name', 'billing_address', 'creditcard_no', 'creditcard_expdate'], 'required'],
            [['billing_id'], 'integer'],
            [['creditcard_no'], 'number'],
            [['creditcard_expdate'], 'safe'],
            [['customer_usr_name', 'name_on_card'], 'string', 'max' => 45],
            [['billing_address'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'billing_id' => 'Billing ID',
            'customer_usr_name' => 'Customer Usr Name',
            'billing_address' => 'Billing Address',
            'creditcard_no' => 'Creditcard No',
            'creditcard_expdate' => 'Creditcard Expdate',
            'name_on_card' => 'Name On Card',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUsrName()
    {
        return $this->hasOne(Customer::className(), ['customer_user_name' => 'customer_usr_name']);
    }
}
