<?php

namespace frontend\modules\cart\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $order_id
 * @property string $customer_user_name
 * @property string $order_date
 * @property string $order_ship_date
 * @property integer $shipper_id
 * @property integer $style_id
 * @property string $billing_address
 * @property string $creditcard_expdate
 * @property string $name_on_card
 * @property string $shipping_address
 * @property string $totalprice
 * @property string $delivery_type
 *
 * @property OrderDetails[] $orderDetails
 * @property ItemDetails[] $idetails
 * @property Customer $customerUserName
 * @property Shipper $shipper
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_user_name'], 'required'],
            [['order_date', 'order_ship_date', 'creditcard_expdate'], 'safe'],
            [['shipper_id', 'style_id'], 'integer'],
            [['customer_user_name', 'totalprice'], 'string', 'max' => 45],
            [['billing_address', 'shipping_address'], 'string', 'max' => 80],
            [['name_on_card'], 'string', 'max' => 40],
            [['delivery_type'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'customer_user_name' => 'Customer User Name',
            'order_date' => 'Order Date',
            'order_ship_date' => 'Order Ship Date',
            'shipper_id' => 'Shipper ID',
            'style_id' => 'Style ID',
            'billing_address' => 'Billing Address',
            'creditcard_expdate' => 'Creditcard Expdate',
            'name_on_card' => 'Name On Card',
            'shipping_address' => 'Shipping Address',
            'totalprice' => 'Totalprice',
            'delivery_type' => 'Delivery Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetails::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdetails()
    {
        return $this->hasMany(ItemDetails::className(), ['idetails_id' => 'idetails_id'])->viaTable('order_details', ['order_id' => 'order_id']);
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
    public function getShipper()
    {
        return $this->hasOne(Shipper::className(), ['shipper_id' => 'shipper_id']);
    }
}
