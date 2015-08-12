<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\customer;
use frontend\models\UserSocialLogin;
use frontend\models\CustomerSocialLogin;
use frontend\models\ProfileSocialLogin;
use frontend\models\DesignerSocialLogin;
use frontend\models\InvestorSocialLogin;
use frontend\models\UserLogin;
use frontend\models\Profile;
use frontend\models\Endorsement;
use frontend\models\Baseprofileforupdate;
use frontend\models\Baseinvestorprofileforupdate;
use frontend\models\Friends;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
	 public $successurl = '';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
			'authfbreg' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallbackfbreg'],
			],
			'authfblogin' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallbackfblog'],
			],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
		
		//$this->redirect('index.php?r=loginregister/default/logout');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
	
	public function successCallbackfbreg($client)
    {	
		$session = new Session;
		$session->open();
        $attributes = $client->getUserAttributes();
		$session['fbattributes'] = $attributes;
        $this->redirect('index.php?r=site/fbregister');
	}
	
	public function actionFbregister()
	{
		$session = new Session;
		$session->open();
		$customerLoginModel = new customer;
		$fbattributes = $session['fbattributes'];
		$session['id'] = $fbattributes['id'];
		$session['fname'] = $fbattributes['first_name'];
		$session['lname'] = $fbattributes['last_name'];
		$session['imgurl'] = 'https://graph.facebook.com/'.$fbattributes['id'];
		$session['gender'] = $fbattributes['gender'];
		$session['email'] = $fbattributes['email'];
		$customerLoginModel->customer_gender = 'M';
		return $this->render('test',['customerLoginModel'=>$customerLoginModel]);
	}
	
	public function successCallbackfblog($client)
    {	
		$session = new Session;
		$session->open();
        $fbattributes = $session['fbattributes'];
		$session['id'] = $fbattributes['id'];
		$session['fname'] = $fbattributes['first_name'];
		$session['lname'] = $fbattributes['last_name'];
		$session['imgurl'] = 'https://graph.facebook.com/'.$fbattributes['id'];
		$session['gender'] = $fbattributes['gender'];
		$session['email'] = $fbattributes['email'];
		
		$UserAlreadyExists = UserSocialLogin::findBySql('select * from user_login where user_name ="'.$session['email'].'"')->all();
		
		if(!$UserAlreadyExists)
		{
		$usersociallogin = new UserSocialLogin();
		$usersociallogin->user_name = $session['email'];
		$usersociallogin->user_password = 'FBLogin_dummy';
		$usersociallogin->user_type = 'C';
		$usersociallogin->insert();
		
		$CustomerSocialLogin = new CustomerSocialLogin();
		$CustomerSocialLogin->customer_user_name = $session['email'];
		$CustomerSocialLogin->customer_first_name = $session['fname'];
		$CustomerSocialLogin->customer_last_name = $session['lname'];
		$CustomerSocialLogin->customer_email = $session['email'];
		if($session['gender'] == 'male')
		{
			$CustomerSocialLogin->customer_gender = 'M';
			$CustomerSocialLogin->insert();
	    }
		else
		{
			$CustomerSocialLogin->customer_gender = 'F';
			$CustomerSocialLogin->insert();
		}
		
	
		$ProfileSocialLogin = new ProfileSocialLogin();
		$ProfileSocialLogin->customer_user_name = $session['email'];
		$ProfileSocialLogin->profile_picture = 'https://graph.facebook.com/'.$session['id'];
		$ProfileSocialLogin->profile_about = 'About Me!';
		$ProfileSocialLogin->insert();
		
		$EndorsementSocialLogin = new Endorsement();
		
		
		$this->redirect('index.php?r=site/home');
		}
		else
		{
		$this->redirect('index.php?r=site/home');
		}
		
	}
	
	public function actionHome()
	{
		echo "Dummy Home Page";
	}
	
	public function actionDestroy()
	{
		$session = new Session;
		$session->open();
		$session->destroy();
		echo "destroyed";
	}
	
	//Not mine
	public function actionCustomerregistration(){
    $model = new UserLogin();
    if ( $model->load(Yii::$app->request->post())  && $model->validate() ) {
		$session = new Session;
		$session->open();
		//$session['var1'] = $_POST['UserLogin[customer_first_name]'];
		print_r(Yii::$app->request->post());
		//$this->redirect('index.php?r=site/dummy');
    }
	else
	{
    return $this->render("samplereg",['model'=>$model]);
    }
    }
	
	//Profiling
	public function actionMycustomerprofilepage()
	{
	    $model = new Profile();
		$session = new Session;
		$session->open();
		$session['user_name'] = '256.cool@gmail.com';
		
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
					$UserProfileExists = Profile::find()->where(['user_name' => $session['user_name']])->count();
					if($UserProfileExists > 0)
					{
					$connection=\Yii::$app->db;
					$connection ->createCommand()->update('profile', ['profile_picture' => $imgPath], 'user_name ="'.$session['user_name'].'"')->execute();
					}
					else
					{
					$ProfileSocialLogin = new ProfileSocialLogin();
					$ProfileSocialLogin->user_name = $session['user_name'];
					$ProfileSocialLogin->profile_picture = $imgPath;
					$ProfileSocialLogin->profile_about = 'About Me!';
					$ProfileSocialLogin->insert();
				}
			 }
				
			}
			return $this->render('mycustomerprofile', ['model' => $model,'about'=>$prof_info->profile_about,'imgPath'=>$imgPath, 'name'=>$name, 'prof_info'=>$prof_info, 'endorsement'=>$endorsement]);
			
	}
	
	public function actionUpdateprofilepost()
	{
		$session = new Session;
		$session->open();
		$postdata = $_POST['updatepost'];
		$scope = $_POST['scope'];
		$connection=\Yii::$app->db;
		$connection ->createCommand()->update('profile', ['profile_about' => $postdata,'publish_data_scope'=>$scope], 'user_name ="'.$session['user_name'].'"')->execute();
	}
	
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
			 $this->redirect('index.php?r=site/mycustomerprofilepage');
			 }
			 if((new UserSocialLogin())->getUserType($session['user_name']) == 'D')
			 {
			 $updateDesigner = $model->updateDesigner($info,$session['user_name']);
			 $this->redirect('index.php?r=site/mydesignerprofilepage');
			 }
		}
	}
	
	public function actionViewmyfriend($username)
	{	
		$session = new Session;
		$session->open();
		$myfriends = Friends::find()->where(['customer_user_name1' => $username, 'friend_status' => 'c'])->all();
		//print_r($myfriends);
		return $this->render('viewmyfriends', ['myfriends' => $myfriends]);
	}
	
	public function actionViewdesigners($username)
	{	
		$session = new Session;
		$session->open();
		$designers = DesignerSocialLogin::find()->all();
		//print_r($myfriends);
		return $this->render('viewdesigners', ['designers' => $designers]);
	}
	
	public function actionViewprofile($username)
	{	
		$session = new Session;
		$session->open();
		$prof_info = (new Profile)->getProfileInfo($username);
		$imgPath = $prof_info->profile_picture;
		
		$endorsement = (new Endorsement)->getUserEndorsementData($username);
		$userlogindata = (new UserLogin)->getUserLoginData($username);
		if((new UserSocialLogin())->getUserType($username) == 'C')
		{
			$name = (new CustomerSocialLogin)->getCustomerInfo($username);
			return $this->render('viewprofile', ['about'=>$prof_info->profile_about,'imgPath'=>$imgPath, 'fname'=>$name->customer_first_name, 'lname'=>$name->customer_last_name, 'prof_info'=>$prof_info, 'endorsement'=>$endorsement,'username'=>$username, 'userlogindata'=>$userlogindata]);
		}
		
		if((new UserSocialLogin())->getUserType($username) == 'D')
		{
			$name = (new DesignerSocialLogin)->getDesignerInfo($username);
			return $this->render('viewprofile', ['about'=>$prof_info->profile_about,'imgPath'=>$imgPath, 'fname'=>$name->designer_first_name, 'lname'=>$name->designer_last_name, 'prof_info'=>$prof_info, 'endorsement'=>$endorsement,'username'=>$username, 'userlogindata'=>$userlogindata]);
		}
		
	}
	
	public function actionMydesignerprofilepage()
	{
	    $model = new Profile();
		$session = new Session;
		$session->open();
		$session['user_name'] = 'DummyDesigner1';
		
		//Fetch profile information from DB
		$prof_info = $model->getProfileInfo($session['user_name']);
		$imgPath = $prof_info->profile_picture;
		$name = (new DesignerSocialLogin)->getDesignerInfo($session['user_name']);
		//$endorsement = (new Endorsement)->getUserEndorsementData($session['user_name']);
		
		//Update profile image and if not already created, create customer profile
		if ($model->load(Yii::$app->request->post()) && $model->validate() && ($_FILES['Profile']['name']['imageFile'] != '')) 
			{	$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
				$imgPath = 'uploads/profilepictures/' . $session['user_name'] . '_profimg.' . $model->imageFile->extension;
				$model->imageFile->saveAs($imgPath);
				$UserProfileExists = Profile::find()->where(['user_name' => $session['user_name']])->count();
				if($UserProfileExists > 0)
				{
				$connection=\Yii::$app->db;
				$connection ->createCommand()->update('profile', ['profile_picture' => $imgPath], 'user_name ="'.$session['user_name'].'"')->execute();
				}
				else
				{
				$ProfileSocialLogin = new ProfileSocialLogin();
				$ProfileSocialLogin->user_name = $session['user_name'];
				$ProfileSocialLogin->profile_picture = $imgPath;
				$ProfileSocialLogin->profile_about = 'About Me!';
				print_r($UserProfileExists);
				$ProfileSocialLogin->insert();
				}	
				
			}
			return $this->render('mydesignerprofile', ['model' => $model,'about'=>$prof_info->profile_about,'imgPath'=>$imgPath, 'name'=>$name, 'prof_info'=>$prof_info]);
			
	}
	
	//Investor Profile Page
	public function actionMyinvestorprofilepage()
	{
	    $model = new Profile();
		$session = new Session;
		$session->open();
		$session['user_name'] = 'DummyInvestor1';
		
		//Fetch profile information from DB
		$name = (new InvestorSocialLogin)->getInvestorInfo($session['user_name']);
		return $this->render('myinvestorprofile', ['model' => $model, 'name'=>$name]);
	}
	
	public function actionUpdateinvestorbasicprofinfo()
	{	 
		$model = new Baseinvestorprofileforupdate();
		 if ( $model->load(Yii::$app->request->post())  && $model->validate()) 
		 {
			 $session = new Session;
			 $session->open();
			 $info = Yii::$app->request->post();
			 $updateInvestor = $model->updateInvestor($info,$session['user_name']);
			 $this->redirect('index.php?r=site/myinvestorprofilepage');
		}
	}
	
}
