<?php

namespace frontend\modules\item\models;

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
	 
	public $img;
	 
	public $specificAttrValVar = array();
	 
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
            [['item_price', 'item_available_qnt','specificAttrValVar'], 'required'],
            [['item_color', 'item_desc', 'item_photo_front', 'item_photo_back', 'item_photo_model1', 'item_photo_model2', 'item_photo_model3', 'item_specificattribute'], 'string'],
			[['img'], 'file', 'extensions' => 'png, jpg'],
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
	
	public function insertItemDetails()
	{
		$this->insert();
		return true;
	}
	
	public function getItemDetailsCount($item_id)
	{
		return $this::find()->where(['item_id'=>$item_id])->count();
	}
	
	public function getItemDetails($item_id)
	{
		return $this::find()->where(['item_id'=>$item_id])->all();
	}
	
	public function getItemColors($itemid)
	{
		$itemColors = $this::findBySql('select distinct item_color from item_details where item_id ="'.$itemid.'"')->all();
		return $itemColors;
	}
	
	public function getItemSizes($itemid,$itemcolor)
	{
		$itemSizes = $this::findBySql('select item_size from item_details where item_id ="'.$itemid.'" AND item_color ="'.$itemcolor.'"')->all();
		return $itemSizes;
	}
	
	public function getItemDetail($itemid,$color,$size)
	{
		return $this::find()->where(['item_id'=>$itemid,'item_color'=>$color,'item_size'=>$size])->one();
	}
	
	public function updateItemDetails()
	{
		$connection=\Yii::$app->db;
		$connection ->createCommand()->update('item_details', ['item_price' => $this->item_price, 'item_desc' => $this->item_desc, 'item_available_qnt' => $this->item_available_qnt, 'item_discountPrice' => $this->item_discountPrice, 'item_discountPer' => $this->item_discountPer, 'item_specificattribute' => $this->item_specificattribute], 'idetails_id ='.$this->idetails_id)->execute();
		return true;
	}
	
	public function deleteItemDetail($idetailid)
	{
		$connection=\Yii::$app->db;
		$connection ->createCommand()
            ->delete('item_details', 'idetails_id = '.$idetailid)
            ->execute();
		return true;
	}
}
