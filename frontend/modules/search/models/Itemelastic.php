<?php

namespace frontend\modules\search\models;

use Yii;

/**
 * This is the model class for table "itemelastic".
 *
 * @property string $item_id
 * @property string $item_name
 * @property string $default_photo
 * @property integer $item_mirrorval
 * @property string $item_designer_id
 * @property integer $item_sub_category_id
 * @property string $item_hashtag
 * @property string $item_upload_time
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
 * @property string $designer_first_name
 */
class Itemelastic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'itemelastic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idetails_id','item_id', 'item_name', 'default_photo', 'item_mirrorval', 'item_designer_id', 'item_sub_category_id', 'item_color', 'item_size', 'item_price', 'item_photo_front', 'item_photo_back', 'item_photo_model1', 'item_photo_model2', 'item_photo_model3', 'item_available_qnt', 'designer_first_name'], 'required'],
            [['default_photo', 'item_color', 'item_desc', 'item_photo_front', 'item_photo_back', 'item_photo_model1', 'item_photo_model2', 'item_photo_model3', 'item_specificattribute'], 'string'],
            [['item_mirrorval', 'item_sub_category_id', 'item_available_qnt'], 'integer'],
            [['item_upload_time'], 'safe'],
            [['item_price', 'item_discountPrice', 'item_discountPer'], 'number'],
            [['item_id'], 'string', 'max' => 60],
            [['item_name', 'item_designer_id'], 'string', 'max' => 45],
            [['item_hashtag'], 'string', 'max' => 30],
            [['item_size'], 'string', 'max' => 10],
            [['designer_first_name'], 'string', 'max' => 50]
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
            'item_name' => 'Item Name',
            'default_photo' => 'Default Photo',
            'item_mirrorval' => 'Item Mirrorval',
            'item_designer_id' => 'Item Designer ID',
            'item_sub_category_id' => 'Item Sub Category ID',
            'item_hashtag' => 'Item Hashtag',
            'item_upload_time' => 'Item Upload Time',
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
            'designer_first_name' => 'Designer First Name',
        ];
    }
}
