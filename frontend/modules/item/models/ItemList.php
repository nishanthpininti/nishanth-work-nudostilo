<?php

namespace frontend\modules\item\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property integer $item_id
 * @property string $item_name
 * @property string $item_desc
 * @property string $item_price
 * @property string $item_discountprice
 * @property string $item_discountpercent
 * @property string $item_photo
 * @property string $item_color
 * @property string $item_size
 * @property integer $item_mirrorval
 * @property string $item_specificattribute
 * @property string $item_designer_id
 * @property integer $item_sub_category_id
 * @property string $item_availability
 *
 * @property Designer $itemDesigner
 * @property SubCategory $itemSubCategory
 */
class ItemList extends \yii\db\ActiveRecord
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
            [['item_name', 'item_price', 'item_photo', 'item_mirrorval', 'item_designer_id', 'item_sub_category_id', 'item_availability'], 'required'],
            [['item_desc', 'item_photo', 'item_specificattribute'], 'string'],
            [['item_price', 'item_discountprice'], 'number'],
            [['item_mirrorval', 'item_sub_category_id'], 'integer'],
            [['item_name', 'item_color', 'item_size', 'item_designer_id'], 'string', 'max' => 45],
            [['item_discountpercent'], 'string', 'max' => 8],
            [['item_availability'], 'string', 'max' => 1]
			
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
            'item_desc' => 'Item Desc',
            'item_price' => 'Item Price',
            'item_discountprice' => 'Item Discountprice',
            'item_discountpercent' => 'Item Discountpercent',
            'item_photo' => 'Item Photo',
            'item_color' => 'Item Color',
            'item_size' => 'Item Size',
            'item_mirrorval' => 'Item Mirrorval',
            'item_specificattribute' => 'Item Specificattribute',
            'item_designer_id' => 'Item Designer ID',
            'item_sub_category_id' => 'Item Sub Category ID',
            'item_availability' => 'Item Availability',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemDesigner()
    {
        return $this->hasOne(Designer::className(), ['designer_user_name' => 'item_designer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemSubCategory()
    {
        return $this->hasOne(SubCategory::className(), ['sub_category_id' => 'item_sub_category_id']);
    }
}
