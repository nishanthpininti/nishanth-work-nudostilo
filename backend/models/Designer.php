<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "designer".
 *
 * @property string $designer_user_name
 * @property string $designer_first_name
 * @property string $designer_last_name
 * @property string $designer_address1
 * @property string $designer_address2
 * @property string $designer_email
 * @property string $designer_gender
 * @property string $designer_from
 * @property string $designer_favcolor
 * @property string $designer_birthdate
 *
 * @property UserLogin $designerUserName
 */
class Designer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'designer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['designer_user_name', 'designer_first_name', 'designer_last_name', 'designer_email', 'designer_gender'], 'required'],
            [['designer_birthdate'], 'safe'],
            [['designer_user_name', 'designer_email'], 'string', 'max' => 45],
            [['designer_first_name'], 'string', 'max' => 50],
            [['designer_last_name'], 'string', 'max' => 80],
            [['designer_address1', 'designer_address2', 'designer_from'], 'string', 'max' => 100],
            [['designer_gender'], 'string', 'max' => 1],
            [['designer_favcolor'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'designer_user_name' => 'Designer User Name',
            'designer_first_name' => 'Designer First Name',
            'designer_last_name' => 'Designer Last Name',
            'designer_address1' => 'Designer Address1',
            'designer_address2' => 'Designer Address2',
            'designer_email' => 'Designer Email',
            'designer_gender' => 'Designer Gender',
            'designer_from' => 'Designer From',
            'designer_favcolor' => 'Designer Favcolor',
            'designer_birthdate' => 'Designer Birthdate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignerUserName()
    {
        return $this->hasOne(UserLogin::className(), ['user_name' => 'designer_user_name']);
    }
}
