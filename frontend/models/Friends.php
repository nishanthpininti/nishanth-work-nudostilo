<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "friends".
 *
 * @property string $customer_user_name1
 * @property string $customer_user_name2
 * @property string $friend_status
 * @property string $scope
 * @property string $privacy_indicator
 * @property integer $sense_of_fashion
 * @property integer $sense_of_style
 * @property integer $decisiveness
 * @property integer $creativity
 *
 * @property Customer $customerUserName1
 * @property Customer $customerUserName2
 */
class Friends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_user_name1', 'customer_user_name2', 'friend_status'], 'required'],
            [['sense_of_fashion', 'sense_of_style', 'decisiveness', 'creativity'], 'integer'],
            [['customer_user_name1', 'customer_user_name2', 'scope', 'privacy_indicator'], 'string', 'max' => 45],
            [['friend_status'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_user_name1' => 'Customer User Name1',
            'customer_user_name2' => 'Customer User Name2',
            'friend_status' => 'Friend Status',
            'scope' => 'Scope',
            'privacy_indicator' => 'Privacy Indicator',
            'sense_of_fashion' => 'Sense Of Fashion',
            'sense_of_style' => 'Sense Of Style',
            'decisiveness' => 'Decisiveness',
            'creativity' => 'Creativity',
        ];
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
        return $this->hasOne(Customer::className(), ['customer_user_name' => 'customer_user_name2']);
    }
	
	public function isFriends($username1, $username2)
	{
		$isFriends = Friends::find()->where(['customer_user_name1' => $username1, 'customer_user_name2' => $username2, 'friend_status' => 'c'])->count();
		if($isFriends > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
