<?php

namespace frontend\modules\item\models;

use Yii;

/**
 * This is the model class for table "colors".
 *
 * @property string $color_name
 */
class Colors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'colors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['color_name'], 'required'],
            [['color_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'color_name' => 'Color Name',
        ];
    }
	
	public function getColors()
	{
		return $this::find()->asArray()->all();
	}
	
}
