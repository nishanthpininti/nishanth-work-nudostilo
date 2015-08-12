<?php

namespace frontend\modules\loginregister\controllers;

require_once(realpath(dirname(__FILE__) . '/../src/Google_Client.php'));
require_once(realpath(dirname(__FILE__) . '/../src/contrib/Google_Oauth2Service.php'));

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Session;
use Yii;
use Google_Client;
use Google_Oauth2Service;
use common\models\LoginForm;
use frontend\modules\loginregister\models\customer;
use frontend\modules\loginregister\models\designer;
use frontend\modules\loginregister\models\investor;
use frontend\modules\loginregister\models\user_login;
use frontend\modules\loginregister\models\Profile;
use frontend\modules\loginregister\models\Endorsement;


class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	/**
     * @inheritdoc
     */
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
	
	public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
		}
        
		$google_client_id = "356959647108-b55ghvpd6gr90tslnu4hhrk5jkulk9a7.apps.googleusercontent.com";
        $google_client_secret = "fpEGyguk37oBA3YDZd2ZkUPT";
        $google_developer_key="AIzaSyAk6JthkoPSpD6I1YGYj7U_8FqzlEQxBVk";
        $google_redirect_url="http://localhost/yii-application/frontend/web/index.php?r=loginregister/default/googlelogin";

        $gClient = new Google_Client();
        $gClient->setApplicationName('Login to Sanwebe.com');
        $gClient->setClientId($google_client_id);
        $gClient->setClientSecret($google_client_secret);
        $gClient->setRedirectUri($google_redirect_url);
        $gClient->setDeveloperKey($google_developer_key);

        $google_oauthV2 = new Google_Oauth2Service($gClient);

        $authUrl = $gClient->createAuthUrl();
        $google_client_id1 = "356959647108-6s1b2sdb3h1169pd9eap7ume952hp6q8.apps.googleusercontent.com";
        $google_client_secret1 = "QE2AuVoCMiYO0NL-tXmCVloF";
        //$google_developer_key="AIzaSyAk6JthkoPSpD6I1YGYj7U_8FqzlEQxBVk";
        $google_redirect_url1="http://localhost/yii-application/frontend/web/index.php?r=loginregister/default/regis";

        $gClient1 = new Google_Client();
        $gClient1->setApplicationName('Login to Sanwebe.com');
        $gClient1->setClientId($google_client_id1);
        $gClient1->setClientSecret($google_client_secret1);
        $gClient1->setRedirectUri($google_redirect_url1);
        $gClient1->setDeveloperKey($google_developer_key);

        $google_oauthV21 = new Google_Oauth2Service($gClient1);

        $authUrl1 = $gClient1->createAuthUrl();

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
			} 
			else {
return $this->render('login', [
                'model' => $model,
            		'authreg' => $authUrl,
            		'authreg1' => $authUrl1,
			]);
		}
    }
	
	//Registration Page action
	public function actionRegistration()
	{
          $customerModel = new customer();
    	  $designerModel = new designer();
    	  $investorModel = new investor();

    	  $customerModel->setScenario('register');
    	  $designerModel->setScenario('register');
    	  $investorModel->setScenario('register');

    		return $this->render('registration',[
    				'designerModel' => $designerModel,
    			    'customerModel' => $customerModel,
    				'investorModel' => $investorModel,
    				'chckuser' => 'B'
    		]);
    }
	
	//Register Customer
	public function actionCustomerregistration()
	{
		$customerModel = new customer();
        $designerModel = new designer();
        $investorModel = new investor();
        $customerModel->setScenario('register');
    	if ( $customerModel->load(Yii::$app->request->post()) && $customerModel->validate()) 
		{
    		if ( $customerModel->customerAndUserInsert() )
			{
    			$session['user_name'] = $customerModel->customer_user_name;
				Yii::$app->session->setFlash('success', 'You have successfully registered!! Please Login to continue.');
    		 	return $this->redirect("index.php?r=loginregister/default/login",["id"=>302]);
    		}
    		else
    		 return $this->render('about');
    	}
		else return $this->render('registration',[
    			'customerModel'=> $customerModel,
    		    'designerModel' => $designerModel,
    		 	'investorModel' => $investorModel,
    			'chckuser' => 'C'
    	]);
    }
	
	//Register Designer
	public function actionDesignerregistration()
	{
    	$customerModel = new customer();
        $designerModel = new designer();
        $investorModel = new investor();
		$designerModel->setScenario('register');
		if ( $designerModel->load(Yii::$app->request->post()) && $designerModel->validate()) 
		{	
    		if ( $designerModel->designerAndUserInsert())
			{
    			$session['user_name'] = $designerModel->designer_user_name;
				Yii::$app->session->setFlash('success', 'You have successfully registered!! Please Login to continue.');
    			return $this->redirect("index.php?r=loginregister/default/login",["id"=>302]);
    		}
    	}
    	else return $this->render('registration',[
    			'customerModel'=> $customerModel,
    		    'designerModel' => $designerModel,
    		 	'investorModel' => $investorModel,
    			'chckuser' => 'D'
    	]);
    }
	
	//Register Investor
	public function actionInvestorregistration()
	{
    	$customerModel = new customer();
        $designerModel = new designer();
        $investorModel = new investor();
        $investorModel->setScenario('register');
    	if ( $investorModel->load(Yii::$app->request->post()) && $investorModel->validate()) 
		{
    		if ( $investorModel->investorAndUserInsert())
			{
    			$session['user_name'] = $investorModel->investor_user_name;
				Yii::$app->session->setFlash('success', 'You have successfully registered!! Please Login to continue.');
    			return $this->redirect("index.php?r=loginregister/default/login",["id"=>302]);
    		}
    	}
    	    	else return $this->render('registration',[
    			'customerModel'=> $customerModel,
    		    'designerModel' => $designerModel,
    		 	'investorModel' => $investorModel,
    			'chckuser' => 'I'
    	]);
    }
	
	//Register with Facebook
	public function successCallbackfbreg($client)
    {
		$session = new Session;
		$session->open();
        $attributes = $client->getUserAttributes();
		$session['fbattributes'] = $attributes;
        $this->redirect('index.php?r=loginregister/default/fbregister');
	}
	public function actionFbregister()
	{
		$session = new Session;
		$session->open();
		$fbattributes = $session['fbattributes'];

		$customerModel = new customer();
		$designerModel = new designer();
		$investorModel = new investor();

		$customerModel->setScenario('register');
		$designerModel->setScenario('register');
		$investorModel->setScenario('register');

		$customerModel->customer_user_name = $fbattributes['email'];
		$designerModel->designer_user_name = $fbattributes['email'];
		$investorModel->investor_user_name = $fbattributes['email'];

		$customerModel->customer_email = $fbattributes['email'];
		$designerModel->designer_email = $fbattributes['email'];
		$investorModel->investor_email = $fbattributes['email'];

		$customerModel->customer_first_name = $fbattributes['first_name'];
		$designerModel->designer_first_name = $fbattributes['first_name'];
		$investorModel->investor_first_name = $fbattributes['first_name'];

		$customerModel->customer_last_name = $fbattributes['last_name'];
		$designerModel->designer_last_name = $fbattributes['last_name'];
		$investorModel->investor_last_name = $fbattributes['last_name'];

		$session['imgurl'] = 'https://graph.facebook.com/'.$fbattributes['id'];

		if (strcmp($fbattributes['gender'], "male")==0)
		{
		 $customerModel->customer_gender = 'M';
		 $designerModel->designer_gender = 'M';
		 $investorModel->investor_gender = 'M';
		}
		else if (strcmp($fbattributes['gender'], "female")==0)
		{
	     $customerModel->customer_gender = 'F';
	     $designerModel->designer_gender = 'F';
	     $investorModel->investor_gender = 'F';
		}

		return $this->render('registration',['customerModel'=>$customerModel,
				'designerModel' => $designerModel,
				'investorModel' => $investorModel,
				'chckuser' => ''
		]);
	}
	
	//Login with Facebook
	public function successCallbackfblog($client)
    {
		$session = new Session;
		$session->open();
		$fbattributes = $client->getUserAttributes();
		$session['id'] = $fbattributes['id'];
		$session['fname'] = $fbattributes['first_name'];
		$session['lname'] = $fbattributes['last_name'];
		$session['imgurl'] = 'https://graph.facebook.com/'.$fbattributes['id'];
		$session['gender'] = $fbattributes['gender'];
		$session['email'] = $fbattributes['email'];
		$session['user_name'] = $session['email'];
		$UserAlreadyExists = (new user_login)->userAlreadyExists($session['email']);
		$this->view->params['customerType'] = 'c';
		if(!$UserAlreadyExists)
		{
		$usersociallogin = (new user_login)->addUser($session['email']);
		$customer = (new customer)->insertCustomerOnLogin();
		$profile = (new Profile)->createProfile($session['email'],'https://graph.facebook.com/'.$session['id']);
		$endorse = (new Endorsement)->createEndorsement($session['email']);
		$this->redirect('index.php?r=loginregister/default/index');
		}
		else
		{
		$this->redirect('index.php?r=loginregister/default/index');
		}

	}
	
	//Register with google
	public function actionRegis()
	{
		session_start();
		$session = Yii::$app->session;
		$google_client_id = "356959647108-6s1b2sdb3h1169pd9eap7ume952hp6q8.apps.googleusercontent.com";
		$google_client_secret = "QE2AuVoCMiYO0NL-tXmCVloF";
		$google_developer_key="AIzaSyAk6JthkoPSpD6I1YGYj7U_8FqzlEQxBVk";
		$google_redirect_url="http://localhost/yii-application/frontend/web/index.php?r=loginregister/default/regis";

		$gClient = new Google_Client();
		$gClient->setApplicationName('Login to Sanwebe.com');
		$gClient->setClientId($google_client_id);
		$gClient->setClientSecret($google_client_secret);
		$gClient->setRedirectUri($google_redirect_url);
		$gClient->setDeveloperKey($google_developer_key);

		$google_oauthV2 = new Google_Oauth2Service($gClient);
		/*
		if (isset($_REQUEST['reset']))
		{
			unset($_SESSION['token']);
			$gClient->revokeToken();
		}*/
		
		//If code is empty, redirect user to google authentication page for code.
		//Code is required to aquire Access Token from google
		//Once we have access token, assign token to session variable
		//and we can redirect user back to page and login.
		if (isset($_GET['code']))
		{
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			//header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
			//return;
		}

		if (isset($_SESSION['token']))
		{
			$gClient->setAccessToken($_SESSION['token']);
		}

		if ($gClient->getAccessToken())
		{
			//For logged in user, get details from google using access token
			$user                 = $google_oauthV2->userinfo->get();
			$user_id              = $user['id'];
			$user_name            = filter_var($user['email'], FILTER_SANITIZE_SPECIAL_CHARS);
			$first_name           = filter_var($user['given_name'],FILTER_SANITIZE_SPECIAL_CHARS);
			$last_name            = filter_var($user['family_name'],FILTER_SANITIZE_SPECIAL_CHARS);
			$email                = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
			$profile_url          = filter_var($user['link'], FILTER_VALIDATE_URL);
			$profile_image_url    = filter_var($user['picture'], FILTER_VALIDATE_URL);
			$gender               = filter_var($user['gender'],FILTER_SANITIZE_SPECIAL_CHARS);
			$personMarkup         = "$email<div><img src='$profile_image_url?sz=50'></div>";
			$_SESSION['token']    = $gClient->getAccessToken();

			$customerModel = new customer();
			$designerModel = new designer();
			$investorModel = new investor();

			$customerModel->setScenario('register');
			$designerModel->setScenario('register');
			$investorModel->setScenario('register');

			$customerModel->customer_user_name = $user_name;
			$customerModel->customer_email = $email;
			$customerModel->customer_first_name = $first_name;
			$customerModel->customer_last_name = $last_name;

			$designerModel->designer_user_name = $user_name;
			$designerModel->designer_email = $email;
			$designerModel->designer_first_name = $first_name;
			$designerModel->designer_last_name = $last_name;

			$investorModel->investor_user_name = $user_name;
			$investorModel->investor_email = $email;
			$investorModel->investor_first_name = $first_name;
			$investorModel->investor_last_name = $last_name;

			if (strcmp($gender, "male")==0){
				$customerModel->customer_gender = 'M';
				$designerModel->designer_gender = 'M';
				$investorModel->investor_gender = 'M';
			}

			else if (strcmp($gender, "female")==0){
				$customerModel->customer_gender = 'F';
				$designerModel->designer_gender = 'F';
				$investorModel->investor_gender = 'F';
			}

			return $this->render('registration', [
					'designerModel'	=> $designerModel,
					'customerModel' => $customerModel,
					'investorModel' => $investorModel,
					'chckuser' => ''

				]);
		}
	}
	
	//Login with Google
	public function actionGooglelogin()
	{
		$session = new Session;
		$session->open();
        $session = Yii::$app->session;
		$google_client_id = "356959647108-b55ghvpd6gr90tslnu4hhrk5jkulk9a7.apps.googleusercontent.com";
		$google_client_secret = "fpEGyguk37oBA3YDZd2ZkUPT";
		$google_developer_key="AIzaSyAk6JthkoPSpD6I1YGYj7U_8FqzlEQxBVk";
		$google_redirect_url="http://localhost/yii-application/frontend/web/index.php?r=loginregister/default/googlelogin";

		$gClient = new Google_Client();
		$gClient->setApplicationName('Login to Sanwebe.com');
		$gClient->setClientId($google_client_id);
		$gClient->setClientSecret($google_client_secret);
		$gClient->setRedirectUri($google_redirect_url);
		$gClient->setDeveloperKey($google_developer_key);

		$google_oauthV2 = new Google_Oauth2Service($gClient);
		/*For logout
		if (isset($_REQUEST['reset']))
		{
			unset($_SESSION['token']);
			$gClient->revokeToken();
			//header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
		}*/
		//$gClient = _get('gclient');

		//If code is empty, redirect user to google authentication page for code.
		//Code is required to aquire Access Token from google
		//Once we have access token, assign token to session variable
		//and we can redirect user back to page and login.
		if (isset($_GET['code']))
		{
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			//header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
			//return;
		}
		if (isset($_SESSION['token']))
		{
			$gClient->setAccessToken($_SESSION['token']);
		}
		if ($gClient->getAccessToken())
		{
			//For logged in user, get details from google using access token
			$user                 = $google_oauthV2->userinfo->get();
			$user_id              = $user['id'];
			$user_name            = filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
			$first_name           = filter_var($user['given_name'],FILTER_SANITIZE_SPECIAL_CHARS);
			$last_name            = filter_var($user['family_name'],FILTER_SANITIZE_SPECIAL_CHARS);
			$email                = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
			$profile_url          = filter_var($user['link'], FILTER_VALIDATE_URL);
			$profile_image_url    = filter_var($user['picture'], FILTER_VALIDATE_URL);
			$gender               = filter_var($user['gender'],FILTER_SANITIZE_SPECIAL_CHARS);
			$personMarkup         = "$email<div><img src='$profile_image_url?sz=50'></div>";
			$_SESSION['token']    = $gClient->getAccessToken();

			$session['email'] = $email;
			$session['fname'] = $first_name;
			$session['lname'] = $last_name;
			$session['email'] = $email;
			$this->redirect('index.php?r=loginregister/default/index');
			$UserAlreadyExists = (new user_login)->userAlreadyExists($session['email']);
			if(!$UserAlreadyExists)
			{
				$usersociallogin = (new user_login)->addUser($session['email']);
				$customer = (new customer)->insertCustomerOnLogin();
				$profile = (new Profile)->createProfile($session['email'],$profile_image_url);
				$endorse = (new Endorsement)->createEndorsement($session['email']);
				$session['user_name'] = $session['email'];
				$this->redirect('index.php?r=loginregister/default/index');
			}
			else
			{
				$session['user_name'] = $session['email'];
				$this->redirect('index.php?r=loginregister/default/index');
			}
			//session_start();
		}
		else
		{
		 echo "Access token not received";
		}
	}
	
	
	public function actionMylogout()
	{
		$session = new Session;
		$session->open();
		$session->destroy();
		$this->redirect('index.php?r=loginregister/default/login');
	}
	
}
