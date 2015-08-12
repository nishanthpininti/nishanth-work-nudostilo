<?php

namespace frontend\modules\item\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $category_id
 * @property string $category_name
 * @property integer $super_category_id
 * @property string $gend_ind
 *
 * @property SuperCategory $superCategory
 * @property SubCategory[] $subCategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name', 'super_category_id', 'gend_ind'], 'safe'],
			[['category_id'],'required'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'super_category_id' => 'Super Category ID',
            'gend_ind' => 'Gend Ind',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperCategory()
    {
        return $this->hasOne(SuperCategory::className(), ['super_category_id' => 'super_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategories()
    {
        return $this->hasMany(SubCategory::className(), ['category_id' => 'category_id']);
    }
	
	public function getCategoriesData($super_category_id)
	{
		return $this::find()->where(['super_category_id'=>$super_category_id])->all();
	}
}
