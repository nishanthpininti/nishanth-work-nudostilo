<?php

namespace frontend\modules\profile\models;

use Yii;

/**
 * This is the model class for table "endorsement".
 *
 * @property string $customer_name
 * @property integer $sense_of_fashion
 * @property integer $sense_of_style
 * @property integer $decisiveness
 * @property integer $creativity
 * @property integer $collaboration
 * @property integer $sense_of_style_counter
 * @property integer $sense_of_fashion_counter
 * @property integer $sense_of_decisiveness_counter
 * @property integer $sense_of_creativity_counter
 * @property integer $sense_of_collaboration_counter
 *
 * @property Customer $customerName
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
            [['customer_name'], 'required'],
            [['sense_of_fashion', 'sense_of_style', 'decisiveness', 'creativity', 'collaboration', 'sense_of_style_counter', 'sense_of_fashion_counter', 'sense_of_decisiveness_counter', 'sense_of_creativity_counter', 'sense_of_collaboration_counter'], 'number'],
            [['customer_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_name' => 'Customer Name',
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
    public function getCustomerName()
    {
        return $this->hasOne(UserLogin::className(), ['user_name' => 'user_name']);
    }
	
	public function getUserEndorsementData($username)
	{
		$endorsement = Endorsement::findBySql('select sense_of_fashion, sense_of_style, decisiveness, creativity, collaboration from endorsement where user_name ="'.$username.'"')->one();
		return $endorsement;
	}
}
