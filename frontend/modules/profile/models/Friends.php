<?php

namespace frontend\modules\profile\models;

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
	
	public function getFriends($username)
	{
		$myfriends = Friends::find()->where(['customer_user_name1' => $username, 'friend_status' => 'c'])->all();
		return $myfriends;
	}
	
	public function updateFriendRating($username1, $username2, $rating, $ratingField)
	{
		$connection=\Yii::$app->db;
		$connection ->createCommand()->update('friends', [$ratingField => $rating], 'customer_user_name1="'.$username1.'" and customer_user_name2="'.$username2.'"')->execute();
		return true;
	}
	
	public function getFriendendorsement($username1,$username2)
	{
		$myEvaluations = Friends::find()->where(['customer_user_name1' => $username1, 'customer_user_name2' => $username2])->one();
		return $myEvaluations;
	}
	
	public function calculateSaveOverallRating($ratingfield,$username)
	{
		$connection=\Yii::$app->db;
		$command = $connection->createCommand("SELECT sum(".$ratingfield.") FROM friends where customer_user_name1='".$username."' and scope = 'close'");
		$sum = $command->queryScalar();
		$closefriendratesum = 2*$sum;
		//$closefriendcount = Friends::find()->where(['customer_user_name1' => $username, 'scope'=>'close'])->count();
		$closefriendcount = Friends::find()->where('customer_user_name1 = :customer_user_name_val and scope = :scope_val and '.$ratingfield.'!= :rating_val' ,['customer_user_name_val' => $username, 'scope_val'=>'close', 'rating_val'=>0])->count();
		if($closefriendcount>0)
		{
		$closefriendcount = ($closefriendcount*2);
		}
		
		$command = $connection->createCommand("SELECT sum(".$ratingfield.") FROM friends where customer_user_name1='".$username."' and scope = 'friend'");
		$friendsum = $command->queryScalar();
		$friendcount = Friends::find()->where('customer_user_name1 = :customer_user_name_val and scope = :scope_val and '.$ratingfield.'!= :rating_val' ,['customer_user_name_val' => $username, 'scope_val'=>'friend', 'rating_val'=>0])->count();
		
		$totalsum = $closefriendratesum + $friendsum;
		$totalcount = $closefriendcount + $friendcount;
		
		if($totalcount>0)
		{
			$newrating = $totalsum/$totalcount;
		}
		else
		{
			$newrating = 0;
		}
		
		$connection ->createCommand()->update('endorsement', [$ratingfield => $newrating], 'user_name ="'.$username.'"')->execute();
		return $closefriendratesum;
	}
	
	public function updateFriendScope($username1, $username2, $scope)
	{
		$connection=\Yii::$app->db;
		$connection ->createCommand()->update('friends', ['scope' => $scope], 'customer_user_name1 ="'.$username1.'" and customer_user_name2 ="'.$username2.'"')->execute();
		
		//change the overall endorsement for user2 as his/her friend scope has changed
		$friendData = Friends::find()->where(['customer_user_name1' => $username2, 'customer_user_name2' => $username1, 'friend_status' => 'c'])->one();
		
		if($friendData['sense_of_fashion'] != 0)
		{
			$updateendorsement = $this->calculateSaveOverallRating('sense_of_fashion',$username2);
		}
		if($friendData['sense_of_style'] != 0)
		{
			$updateendorsement = $this->calculateSaveOverallRating('sense_of_style',$username2);
		}
		if($friendData['decisiveness']  != 0)
		{
			$updateendorsement = $this->calculateSaveOverallRating('decisiveness',$username2);
		}
		if($friendData['creativity']  != 0)
		{
			$updateendorsement = $this->calculateSaveOverallRating('creativity',$username2);
		}
		
		return true;
	}
}
