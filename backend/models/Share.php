<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "share".
 *
 * @property integer $share_id
 * @property string $customer_user_name
 * @property integer $style_id
 * @property string $scope
 * @property string $time_stamp
 *
 * @property Comments[] $comments
 * @property Customer[] $customerUserNames
 * @property Customer $customerUserName
 * @property Styles $style
 */
class Share extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'share';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['share_id', 'customer_user_name', 'style_id', 'scope'], 'required'],
            [['share_id', 'style_id'], 'integer'],
            [['time_stamp'], 'safe'],
            [['customer_user_name', 'scope'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'share_id' => 'Share ID',
            'customer_user_name' => 'Customer User Name',
            'style_id' => 'Style ID',
            'scope' => 'Scope',
            'time_stamp' => 'Time Stamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['share_id' => 'share_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserNames()
    {
        return $this->hasMany(Customer::className(), ['customer_user_name' => 'customer_user_name'])->viaTable('comments', ['share_id' => 'share_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserName()
    {
        return $this->hasOne(Customer::className(), ['customer_user_name' => 'customer_user_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStyle()
    {
        return $this->hasOne(Styles::className(), ['style_id' => 'style_id']);
    }
}
