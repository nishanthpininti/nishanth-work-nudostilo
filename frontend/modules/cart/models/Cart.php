<?php

namespace frontend\modules\cart\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property string $customer_user_name
 * @property integer $idetails_id
 *
 * @property Customer $customerUserName
 * @property ItemDetails $idetails
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_user_name', 'idetails_id'], 'required'],
            [['idetails_id'], 'integer'],
            [['customer_user_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_user_name' => 'Customer User Name',
            'idetails_id' => 'Idetails ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserName()
    {
        return $this->hasOne(Customer::className(), ['customer_user_name' => 'customer_user_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdetails()
    {
        return $this->hasOne(ItemDetails::className(), ['idetails_id' => 'idetails_id']);
    }
}
