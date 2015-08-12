<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "styles".
 *
 * @property integer $style_id
 * @property integer $item_id
 *
 * @property Send[] $sends
 * @property Share[] $shares
 * @property Item $item
 */
class Styles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'styles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['style_id', 'item_id'], 'required'],
            [['style_id', 'item_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'style_id' => 'Style ID',
            'item_id' => 'Item ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSends()
    {
        return $this->hasMany(Send::className(), ['sytle_id' => 'style_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShares()
    {
        return $this->hasMany(Share::className(), ['style_id' => 'style_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['item_id' => 'item_id']);
    }
}
