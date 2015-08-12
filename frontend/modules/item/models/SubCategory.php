<?php

namespace frontend\modules\item\models;

use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property integer $sub_category_id
 * @property string $sub_category_name
 * @property string $sub_category_specificattribute
 * @property integer $category_id
 *
 * @property Item[] $items
 * @property Category $category
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_category_name', 'category_id','sub_category_specificattribute'], 'safe'],
            [['sub_category_id'],'required'],];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sub_category_id' => 'Sub Category ID',
            'sub_category_name' => 'Sub Category Name',
            'sub_category_specificattribute' => 'Sub Category Specificattribute',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['item_sub_category_id' => 'sub_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }
	
	public function getSubCategoriesData($category_id)
	{
		return $this::find()->where(['category_id'=>$category_id])->all();
	}
	
	public function getSpecificAttributes($sub_category_id)
	{
		return SubCategory::findBySql('select sub_category_specificattribute from sub_category where sub_category_id='.$sub_category_id)->one(); 
	}
}
