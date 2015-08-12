<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "style_me".
 *
 * @property integer $style_me_id
 * @property string $customer_user_name1
 * @property integer $style_id
 * @property string $customer_user_name2
 * @property string $my_comment
 * @property string $friends_comment
 * @property string $end_date
 * @property string $completion_status
 *
 * @property Styles $style
 * @property Customer $customerUserName1
 * @property Comments $customerUserName2
 */
class StyleMe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'style_me';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['style_me_id', 'customer_user_name1', 'style_id', 'customer_user_name2', 'end_date'], 'required'],
            [['style_me_id', 'style_id'], 'integer'],
            [['my_comment', 'friends_comment', 'completion_status'], 'string'],
            [['end_date'], 'safe'],
            [['customer_user_name1', 'customer_user_name2'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'style_me_id' => 'Style Me ID',
            'customer_user_name1' => 'Customer User Name1',
            'style_id' => 'Style ID',
            'customer_user_name2' => 'Customer User Name2',
            'my_comment' => 'My Comment',
            'friends_comment' => 'Friends Comment',
            'end_date' => 'End Date',
            'completion_status' => 'Completion Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStyle()
    {
        return $this->hasOne(Styles::className(), ['style_id' => 'style_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserName1()
    {
        return $this->hasOne(Customer::className(), ['customer_user_name' => 'customer_user_name1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerUserName2()
    {
        return $this->hasOne(Comments::className(), ['customer_user_name' => 'customer_user_name2']);
    }
}
