<?php

namespace frontend\modules\cart\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $address_id
 * @property string $customer_user_name
 * @property string $customer_full_name
 * @property string $Address_line_1
 * @property string $Address_line_2
 * @property string $city
 * @property string $state
 * @property integer $zip
 * @property string $country
 * @property integer $phone_number
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_user_name'], 'required'],
            [['zip', 'phone_number'], 'integer'],
            [['customer_user_name', 'customer_full_name', 'city', 'state', 'country'], 'string', 'max' => 45],
            [['Address_line_1', 'Address_line_2'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'address_id' => 'Address ID',
            'customer_user_name' => 'Customer User Name',
            'customer_full_name' => 'Customer Full Name',
            'Address_line_1' => 'Address Line 1',
            'Address_line_2' => 'Address Line 2',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'country' => 'Country',
            'phone_number' => 'Phone Number',
        ];
    }
}
