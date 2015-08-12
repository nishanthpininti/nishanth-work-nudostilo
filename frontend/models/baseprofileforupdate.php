<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "profile".
 *
 * @property string $customer_user_name
 * @property string $profile_picture
 * @property string $profile_about
 *
 * @property Customer $customerUserName
 */
class Baseprofileforupdate extends Model
{
    /**
     * @inheritdoc
     */
    /**
     * @inheritdoc
     */
	public $firstname;
	public $lastname;
	public $currentcity;
	public $currentstate;
	public $nativecity;
	public $nativestate;
	
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'required'],
            [['firstname'], 'string', 'max' => 45],
            [['lastname','currentcity','currentstate','nativecity','nativestate'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'currentcity' => 'Current City',
			'currentstate' => 'Current State',
			'nativecity' => 'Native City',
			'nativestate' => 'Native State',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
	public function updateCustomer($info, $username)
	{
			$connection=\Yii::$app->db;
			 //Update customer table
			 $connection ->createCommand()->update('customer', ['customer_first_name' => $info['Baseprofileforupdate']['firstname'],'customer_last_name'=>$info['Baseprofileforupdate']['lastname']], 'customer_user_name ="'.$username.'"')->execute();
			 //update profile table
			 $connection ->createCommand()->update('profile', ['user_lives_in_city' => $info['Baseprofileforupdate']['currentcity'], 
			 'user_lives_in_state' => $info['Baseprofileforupdate']['currentstate'], 'user_from_city' => $info['Baseprofileforupdate']['nativecity'], 'user_from_state' => $info['Baseprofileforupdate']['nativestate']], 'user_name ="'.$username.'"')->execute();
			 return true;
	}
	
	public function updateDesigner($info, $username)
	{
			$connection=\Yii::$app->db;
			 //Update Designer table
			 $connection ->createCommand()->update('designer', ['designer_first_name' => $info['Baseprofileforupdate']['firstname'],'designer_last_name'=>$info['Baseprofileforupdate']['lastname']], 'designer_user_name ="'.$username.'"')->execute();
			 //update profile table
			 $connection ->createCommand()->update('profile', ['user_lives_in_city' => $info['Baseprofileforupdate']['currentcity'], 
			 'user_lives_in_state' => $info['Baseprofileforupdate']['currentstate'], 'user_from_city' => $info['Baseprofileforupdate']['nativecity'], 'user_from_state' => $info['Baseprofileforupdate']['nativestate']], 'user_name ="'.$username.'"')->execute();
			 return true;
	}
}
