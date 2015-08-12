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
class Baseinvestorprofileforupdate extends Model
{
    /**
     * @inheritdoc
     */
    /**
     * @inheritdoc
     */
	public $firstname;
	public $lastname;
	
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'required'],
            [['firstname'], 'string', 'max' => 45],
            [['lastname'], 'string', 'max' => 80]
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
            ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
	public function updateInvestor($info, $username)
	{
			$connection=\Yii::$app->db;
			 //Update customer table
			 $connection ->createCommand()->update('investor', ['investor_first_name' => $info['Baseinvestorprofileforupdate']['firstname'],'investor_last_name'=>$info['Baseinvestorprofileforupdate']['lastname']], 'investor_user_name ="'.$username.'"')->execute();
			 return true;
	}
	
}
