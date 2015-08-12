<?php

namespace frontend\modules\cart\models;

use Yii;

/**
 * This is the model class for table "order_details".
 *
 * @property integer $order_id
 * @property integer $idetails_id
 * @property integer $quantity
 * @property string $order_status
 * @property string $designer_id
 * @property string $delivery_name
 * @property string $tracking_number
 *
 * @property ItemDetails $idetails
 * @property Order $order
 */
class OrderDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'idetails_id', 'order_status'], 'required'],
            [['order_id', 'idetails_id', 'quantity'], 'integer'],
            [['order_status', 'designer_id', 'delivery_name', 'tracking_number'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'idetails_id' => 'Idetails ID',
            'quantity' => 'Quantity',
            'order_status' => 'Order Status',
            'designer_id' => 'Designer ID',
            'delivery_name' => 'Delivery Name',
            'tracking_number' => 'Tracking Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdetails()
    {
        return $this->hasOne(ItemDetails::className(), ['idetails_id' => 'idetails_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_id' => 'order_id']);
    }
}
