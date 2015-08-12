<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "super_category".
 *
 * @property integer $super_category_id
 * @property string $super_category_name
 *
 * @property Category[] $categories
 */
class SuperCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'super_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['super_category_name'], 'required'],
            [['super_category_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'super_category_id' => 'Super Category ID',
            'super_category_name' => 'Super Category Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['super_category_id' => 'super_category_id']);
    }
}
