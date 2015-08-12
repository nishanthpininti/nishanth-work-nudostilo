<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "investor".
 *
 * @property string $investor_user_name
 * @property string $investor_first_name
 * @property string $investor_last_name
 * @property string $investor_address1
 * @property string $investor_address2
 * @property string $investor_email
 * @property string $investor_gender
 *
 * @property UserLogin $investorUserName
 */
class Investor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'investor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['investor_user_name', 'investor_first_name', 'investor_last_name', 'investor_email', 'investor_gender'], 'required'],
            [['investor_user_name', 'investor_email'], 'string', 'max' => 45],
            [['investor_first_name'], 'string', 'max' => 50],
            [['investor_last_name'], 'string', 'max' => 80],
            [['investor_address1', 'investor_address2'], 'string', 'max' => 100],
            [['investor_gender'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'investor_user_name' => 'Investor User Name',
            'investor_first_name' => 'Investor First Name',
            'investor_last_name' => 'Investor Last Name',
            'investor_address1' => 'Investor Address1',
            'investor_address2' => 'Investor Address2',
            'investor_email' => 'Investor Email',
            'investor_gender' => 'Investor Gender',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvestorUserName()
    {
        return $this->hasOne(UserLogin::className(), ['user_name' => 'investor_user_name']);
    }
}
