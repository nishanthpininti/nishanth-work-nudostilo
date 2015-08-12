<?php

namespace frontend\modules\profile\controllers;

use yii\web\Controller;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\web\UploadedFile;
use Yii;
use frontend\modules\profile\models\Profile;
use frontend\modules\profile\models\CustomerSocialLogin;
use frontend\modules\profile\models\Endorsement;
use frontend\modules\profile\models\ProfileSocialLogin;
use frontend\modules\profile\models\Baseprofileforupdate;
use frontend\modules\profile\models\UserSocialLogin;
use frontend\modules\profile\models\Friends;
use frontend\modules\profile\models\UserLogin;
use frontend\modules\profile\models\DesignerSocialLogin;
use frontend\modules\profile\models\InvestorSocialLogin;
use frontend\modules\profile\models\Baseinvestorprofileforupdate;
use frontend\modules\profile\models\CustDesEndorsement;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	//View My Profile page for logged in customer
	public function actionMycustomerprofilepage()
	{
	    $model = new Profile();
		$session = new Session;
		$session->open();
		//$session['user_name'] = '256.cool@gmail.com';
		//Fetch profile information from DB
		$prof_info = $model->getProfileInfo($session['user_name']);
		$imgPath = $prof_info->profile_picture;
		$name = (new CustomerSocialLogin)->getCustomerInfo($session['user_name']);
		$endorsement = (new Endorsement)->getUserEndorsementData($session['user_name']);
		//Update profile image and if not already created, create customer profile
		if ($model->load(Yii::$app->request->post()) && $model->validate()) 
			{	$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
				if(isset($model->imageFile->extension))
				{
					$imgPath = 'uploads/profilepictures/' . $session['user_name'] . '_profimg.' . $model->imageFile->extension;
					$model->imageFile->saveAs($imgPath);
					$UserProfileExists = (new Profile)->updateCreateProfileForImage($imgPath,$session['user_name']);
				}
			 }
		return $this->render('mycustomerprofile', ['model' => $model,'about'=>$prof_info->profile_about,'imgPath'=>$imgPath, 'name'=>$name, 'prof_info'=>$prof_info, 'endorsement'=>$endorsement]);
	}
	
	//View My profile page for logged in designer
	public function actionMydesignerprofilepage()
	{
	    $model = new Profile();
		$designerModel = new DesignerSocialLogin();
		$session = new Session;
		$session->open();
		//$session['user_name'] = 'DummyDesigner1';
		//Fetch profile information from DB
		$prof_info = $model->getProfileInfo($session['user_name']);
		$imgPath = $prof_info->profile_picture;
		$name = (new DesignerSocialLogin)->getDesignerInfo($session['user_name']);
		$endorsement = (new Endorsement)->getUserEndorsementData($session['user_name']);
		//Update profile image and if not already created, create customer profile
		if ($model->load(Yii::$app->request->post()) && $model->validate()) 
			{	
				$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
				if(isset($model->imageFile->extension))
				{
					$imgPath = 'uploads/profilepictures/' . $session['user_name'] . '_profimg.' . $model->imageFile->extension;
					$model->imageFile->saveAs($imgPath);
					$UserProfileExists = (new Profile)->updateCreateProfileForImage($imgPath,$session['user_name']);
				}
			}
		return $this->render('mydesignerprofile', ['model' => $model,'about'=>$prof_info->profile_about,'imgPath'=>$imgPath, 'name'=>$name, 'prof_info'=>$prof_info, 'endorsement'=>$endorsement,'designerModel'=>$designerModel]);
	}
	
	//View my investor profile page
	public function actionMyinvestorprofilepage()
	{
	    $model = new Profile();
		$session = new Session;
		$session->open();
		//$session['user_name'] = 'DummyInvestor1';
		//Fetch profile information from DB
		$name = (new InvestorSocialLogin)->getInvestorInfo($session['user_name']);
		return $this->render('myinvestorprofile', ['model' => $model, 'name'=>$name]);
	}
	
	//Update my profile post
	public function actionUpdateprofilepost()
	{
		$session = new Session;
		$session->open();
		$postdata = $_POST['updatepost'];
		if(isset($_POST['scope']))
		{
		$scope = $_POST['scope'];
		}
		else
		{
		$scope = 0;
		}
		$connection=\Yii::$app->db;
		$connection ->createCommand()->update('profile', ['profile_about' => $postdata,'publish_data_scope'=>$scope], 'user_name ="'.$session['user_name'].'"')->execute();
	}
	
	//Update basic prof info (eg. name, lives in city/state, from city/state)
	public function actionUpdatebasicprofinfo()
	{	 
		$model = new Baseprofileforupdate();
		 if ( $model->load(Yii::$app->request->post())  && $model->validate()) 
		 {
			 $session = new Session;
			 $session->open();
			 $info = Yii::$app->request->post();
			 if((new UserSocialLogin())->getUserType($session['user_name']) == 'C')
			 {
			 $updateCustomer = $model->updateCustomer($info,$session['user_name']);
			 $this->redirect('index.php?r=profile/default/mycustomerprofilepage');
			 }
			 if((new UserSocialLogin())->getUserType($session['user_name']) == 'D')
			 {
			 $updateDesigner = $model->updateDesigner($info,$session['user_name']);
			 $this->redirect('index.php?r=profile/default/mydesignerprofilepage');
			 }
		}
	}
	
	//Update basic prof info (fname and lname) for investor
	public function actionUpdateinvestorbasicprofinfo()
	{	 
		$model = new Baseinvestorprofileforupdate();
		 if ( $model->load(Yii::$app->request->post())  && $model->validate()) 
		 {
			 $session = new Session;
			 $session->open();
			 $info = Yii::$app->request->post();
			 $updateInvestor = $model->updateInvestor($info,$session['user_name']);
			 $this->redirect('index.php?r=profile/default/myinvestorprofilepage');
		}
	}
	
	//View customer friends (Friend List)
	public function actionViewmyfriend($username)
	{	
		$myfriends = (new Friends)->getFriends($username);
		return $this->render('viewmyfriends', ['myfriends' => $myfriends]);
	}
	
	//View all the designers (Designer List) for investor
	public function actionViewdesigners($username)
	{	
		$designers = DesignerSocialLogin::find()->all();
		return $this->render('viewdesigners', ['designers' => $designers]);
	}
	
	//View profile of customer or Designer
	public function actionViewprofile($username)
	{	
		$session = new Session;
		$session->open();
		if($username == $session['user_name'])
		{
		$this->redirect('index.php?r=profile/default/mycustomerprofilepage');
		}
		$prof_info = (new Profile)->getProfileInfo($username);
		$imgPath = $prof_info->profile_picture;
		$endorsement = (new Endorsement)->getUserEndorsementData($username);
		$userlogindata = (new UserLogin)->getUserLoginData($username);
		if((new UserSocialLogin())->getUserType($username) == 'C')
		{
			$name = (new CustomerSocialLogin)->getCustomerInfo($username);
			$myEvaluations = (new Friends)->getFriendendorsement($username, $session['user_name']);
			$canRate = true;
			return $this->render('viewprofile', ['about'=>$prof_info->profile_about,'imgPath'=>$imgPath, 'fname'=>$name->customer_first_name, 'lname'=>$name->customer_last_name, 'prof_info'=>$prof_info, 'endorsement'=>$endorsement,'username'=>$username, 'userlogindata'=>$userlogindata,'myEvaluations'=>$myEvaluations,'canRate'=>$canRate]);
		}
		if((new UserSocialLogin())->getUserType($username) == 'D')
		{
			$name = (new DesignerSocialLogin)->getDesignerInfo($username);
			$myEvaluations = (new CustDesEndorsement)->getDesignerendorsementbyme($username, $session['user_name']);
			$canRate = (new CustDesEndorsement)->showEndorsementToCustomer($session['user_name'],$username);
			if(!isset($myEvaluations))
			{
				$myEvaluations = 'DummySetting';
			}
			return $this->render('viewprofile', ['about'=>$prof_info->profile_about,'imgPath'=>$imgPath, 'fname'=>$name->designer_first_name, 'lname'=>$name->designer_last_name, 'prof_info'=>$prof_info, 'endorsement'=>$endorsement,'username'=>$username, 'userlogindata'=>$userlogindata,'myEvaluations'=>$myEvaluations,'canRate'=>$canRate]);
		}
	}
	
	//update overall endorsement of customer/designer in endorsement table
	public function actionUpdateendorsement()
	{
		$session = new Session;
		$session->open();
		$friendun = $_POST['friendun'];
		$rating = $_POST['rating'];
		$ratefield = $_POST['ratefield'];
		if((new UserSocialLogin())->getUserType($friendun) == 'C')
		{$updateFriendRating = (new Friends)->updateFriendRating($friendun,$session['user_name'],$rating,$ratefield);
		$calculateSaveOverallRating = (new Friends)->calculateSaveOverallRating($ratefield, $friendun);
		}
		if((new UserSocialLogin())->getUserType($friendun) == 'D')
		{$updateDesignerRating = (new CustDesEndorsement)->updateDesignerRating($friendun,$session['user_name'],$rating,$ratefield);
		$calculateSaveOverallRating = (new CustDesEndorsement)->calculateSaveOverallRating($ratefield, $friendun);
		}
	}
	
	//update the scope of friends
	public function actionUpdateclosefriendscope()
	{
		$session = new Session;
		$session->open();
		$frndun = $_POST['frndun'];
		$scope = $_POST['scope'];
		$updateScope = (new Friends)->updateFriendScope($session['user_name'],$frndun,$scope);
	}
	
}
