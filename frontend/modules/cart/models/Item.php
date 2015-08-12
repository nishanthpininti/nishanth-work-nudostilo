<?php

namespace frontend\modules\cart\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property string $item_id
 * @property string $item_name
 * @property string $default_photo
 * @property integer $item_mirrorval
 * @property string $item_designer_id
 * @property integer $item_sub_category_id
 * @property string $item_hashTag
 * @property string $item_upload_time
 *
 * @property Cart[] $carts
 * @property Customer[] $customerUserNames
 * @property ItemDetails[] $itemDetails
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'item_name', 'default_photo', 'item_mirrorval', 'item_designer_id', 'item_sub_category_id'], 'required'],
            [['default_photo'], 'string'],
            [['item_mirrorval', 'item_sub_category_id'], 'integer'],
            [['item_upload_time'], 'safe'],
            [['item_id'], 'string', 'max' => 60],
            [['item_name', 'item_designer_id'], 'string', 'max' => 45],
            [['item_hashTag'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'item_name' => 'Item Name',
            'default_photo' => 'Default Photo',
            'item_mirrorval' => 'Item Mirrorval',
            'item_designer_id' => 'Item Designer ID',
            'item_sub_category_id' => 'Item Sub Category ID',
            'item_hashTag' => 'Item Hash Tag',
            'item_upload_time' => 'Item Upload Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserNames()
    {
        return $this->hasMany(Customer::className(), ['customer_user_name' => 'customer_user_name'])->viaTable('cart', ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemDetails()
    {
        return $this->hasMany(ItemDetails::className(), ['item_id' => 'item_id']);
    }
}
