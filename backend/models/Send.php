<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "send".
 *
 * @property string $customer_user_name1
 * @property integer $sytle_id
 * @property string $customer_user_name2
 *
 * @property Customer $customerUserName1
 * @property Customer $customerUserName2
 * @property Styles $sytle
 */
class Send extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'send';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_user_name1', 'sytle_id', 'customer_user_name2'], 'required'],
            [['sytle_id'], 'integer'],
            [['customer_user_name1', 'customer_user_name2'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_user_name1' => 'Customer User Name1',
            'sytle_id' => 'Sytle ID',
            'customer_user_name2' => 'Customer User Name2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserName1()
    {
        return $this->hasOne(Customer::className(), ['customer_user_name' => 'customer_user_name1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserName2()
    {
        return $this->hasOne(Customer::className(), ['customer_user_name' => 'customer_user_name2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSytle()
    {
        return $this->hasOne(Styles::className(), ['style_id' => 'sytle_id']);
    }
}
