<?php

namespace frontend\modules\loginregister\models;

use Yii;

/**
 * This is the model class for table "endorsement".
 *
 * @property string $user_name
 * @property double $sense_of_fashion
 * @property double $sense_of_style
 * @property double $decisiveness
 * @property double $creativity
 * @property double $collaboration
 * @property integer $sense_of_style_counter
 * @property integer $sense_of_fashion_counter
 * @property integer $sense_of_decisiveness_counter
 * @property integer $sense_of_creativity_counter
 * @property integer $sense_of_collaboration_counter
 *
 * @property UserLogin $userName
 */
class Endorsement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'endorsement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name'], 'required'],
            [['sense_of_fashion', 'sense_of_style', 'decisiveness', 'creativity', 'collaboration'], 'number'],
            [['sense_of_style_counter', 'sense_of_fashion_counter', 'sense_of_decisiveness_counter', 'sense_of_creativity_counter', 'sense_of_collaboration_counter'], 'integer'],
            [['user_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_name' => 'User Name',
            'sense_of_fashion' => 'Sense Of Fashion',
            'sense_of_style' => 'Sense Of Style',
            'decisiveness' => 'Decisiveness',
            'creativity' => 'Creativity',
            'collaboration' => 'Collaboration',
            'sense_of_style_counter' => 'Sense Of Style Counter',
            'sense_of_fashion_counter' => 'Sense Of Fashion Counter',
            'sense_of_decisiveness_counter' => 'Sense Of Decisiveness Counter',
            'sense_of_creativity_counter' => 'Sense Of Creativity Counter',
            'sense_of_collaboration_counter' => 'Sense Of Collaboration Counter',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserName()
    {
        return $this->hasOne(UserLogin::className(), ['user_name' => 'user_name']);
    }
	
	public function createEndorsement($username)
	{
		$this->user_name = $username;
		$this->insert();
	}
}
