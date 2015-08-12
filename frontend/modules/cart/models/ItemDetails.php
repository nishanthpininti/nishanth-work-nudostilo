<?php

namespace frontend\modules\cart\models;

use Yii;

/**
 * This is the model class for table "item_details".
 *
 * @property integer $idetails_id
 * @property string $item_id
 * @property string $item_color
 * @property string $item_size
 * @property string $item_price
 * @property string $item_desc
 * @property string $item_photo_front
 * @property string $item_photo_back
 * @property string $item_photo_model1
 * @property string $item_photo_model2
 * @property string $item_photo_model3
 * @property integer $item_available_qnt
 * @property string $item_discountPrice
 * @property string $item_discountPer
 * @property string $item_specificattribute
 *
 * @property Item $item
 */
class ItemDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'item_color', 'item_size', 'item_price', 'item_photo_front', 'item_photo_back', 'item_photo_model1', 'item_photo_model2', 'item_photo_model3', 'item_available_qnt'], 'required'],
            [['item_color', 'item_desc', 'item_photo_front', 'item_photo_back', 'item_photo_model1', 'item_photo_model2', 'item_photo_model3', 'item_specificattribute'], 'string'],
            [['item_price', 'item_discountPrice', 'item_discountPer'], 'number'],
            [['item_available_qnt'], 'integer'],
            [['item_id'], 'string', 'max' => 60],
            [['item_size'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idetails_id' => 'Idetails ID',
            'item_id' => 'Item ID',
            'item_color' => 'Item Color',
            'item_size' => 'Item Size',
            'item_price' => 'Item Price',
            'item_desc' => 'Item Desc',
            'item_photo_front' => 'Item Photo Front',
            'item_photo_back' => 'Item Photo Back',
            'item_photo_model1' => 'Item Photo Model1',
            'item_photo_model2' => 'Item Photo Model2',
            'item_photo_model3' => 'Item Photo Model3',
            'item_available_qnt' => 'Item Available Qnt',
            'item_discountPrice' => 'Item Discount Price',
            'item_discountPer' => 'Item Discount Per',
            'item_specificattribute' => 'Item Specificattribute',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['item_id' => 'item_id']);
    }
}
