<?php

namespace frontend\modules\profile\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use frontend\modules\profile\models\ProfileSocialLogin;

class Profile extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
	public $updatePost;
	public $scope;
	public static function tableName()
    {
        return 'profile';
    }
	
    public function rules()
    {
        return [
			[['imageFile'], 'file', 'extensions'=>['png','jpg']],
			//[['imageFile'], ],
			//,,'skipOnEmpty' => false , ],
        ];
    }
	
	public function attributeLabels()
    {
        return [
            'imageFile' => 'Profile Picture',
			'scope' => 'Publish To',
            ];
    }
	
	public function getProfileInfo($username)
	{
		$prof_info = Profile::findBySql('select profile_about, profile_picture, user_lives_in_city, user_lives_in_state, user_from_city, user_from_state, publish_data_scope from profile where user_name ="'.$username.'"')->one();
		return $prof_info;
	}
	
	public function updateCreateProfileForImage($imgPath,$username)
	{
		$UserProfileExists = Profile::find()->where(['user_name' => $username])->count();
		if($UserProfileExists > 0)
		{
		$connection=\Yii::$app->db;
		$connection ->createCommand()->update('profile', ['profile_picture' => $imgPath], 'user_name ="'.$username.'"')->execute();
		}
		else
		{
		$ProfileSocialLogin = new ProfileSocialLogin();
		$ProfileSocialLogin->user_name = $username;
		$ProfileSocialLogin->profile_picture = $imgPath;
		$ProfileSocialLogin->profile_about = 'About Me!';
		$ProfileSocialLogin->insert();
		}
		return true;
	}
}