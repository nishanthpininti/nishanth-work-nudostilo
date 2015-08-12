<?php

namespace frontend\modules\item\models;

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
 *
 * @property ItemDetails[] $itemDetails
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 
	public $numberOfColors;
	public $itemColors = array();
	public $itemSize = array();
	public $itemImgFront = array();
	public $itemImgBack = array();
	public $itemImgModel1 = array();
	public $itemImgModel2 = array();
	public $itemImgModel3 = array();
	
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
            [['item_id', 'item_name', 'default_photo', 'item_mirrorval', 'item_designer_id', 'item_sub_category_id','itemColors','itemSize','itemImgFront','itemImgBack','itemImgModel1','itemImgModel2','itemImgModel3'], 'required'],
            [['default_photo'], 'string'],
			[['numberOfColors'],'safe'],
            [['item_mirrorval', 'item_sub_category_id'], 'integer'],
            [['item_id'], 'string', 'max' => 60],
            [['item_name', 'item_designer_id'], 'string', 'max' => 45],
            [['item_hashTag'], 'string', 'max' => 30],
			[['itemImgFront'], 'file', 'extensions' => 'png, jpg'],
			[['itemImgBack'], 'file', 'extensions' => 'png, jpg'],
			[['itemImgModel1'], 'file', 'extensions' => 'png, jpg'],
			[['itemImgModel2'], 'file', 'extensions' => 'png, jpg'],
			[['itemImgModel3'], 'file', 'extensions' => 'png, jpg']
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemDetails()
    {
        return $this->hasMany(ItemDetails::className(), ['item_id' => 'item_id']);
    }
	
	public function getItemCount()
	{
		return Item::find()->count();
	}
	
	public function insertItem()
	{
		$this->default_photo = 'dummy';
		$this->itemColors = 'dummy';
		$this->itemSize = 'dummy';
		$this->itemImgFront = 'dummy';
		$this->itemImgBack = 'dummy';
		$this->itemImgModel1 = 'dummy';
		$this->itemImgModel2 = 'dummy';
		$this->itemImgModel3 = 'dummy';
		$this->insert();
		return true;
	}
	
	public function getItemData($item_id)
	{
		return $this::find()->where(['item_id'=>$item_id])->one();
	}
	
	public function updateItem($itemId,$itemName,$itemMirrVal,$itemhash)
	{
		$connection=\Yii::$app->db;
		$connection ->createCommand()->update('item', ['item_name' => $itemName, 'item_mirrorval' => $itemMirrVal, 'item_hashTag' => $itemhash], 'item_id ="'.$itemId.'"')->execute();
		return true;
	}
}
