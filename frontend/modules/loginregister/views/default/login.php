<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->context->layout = null;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            
				<!--Register with FB -->
			<?php use yii\authclient\widgets\AuthChoice; ?>
			<?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['loginregister/default/authfbreg'], 'autoRender' => false, 'popupMode' => false]); ?>
			
			<?php foreach ($authAuthChoice->getClients() as $client): ?>
			<?= Html::a( 'Register with '. $client->title, ['default/authfbreg', 'authclient'=> $client->name, ], ['class' => "btn btn-primary $client->name "]) ?>
			<?php endforeach; ?>
			
			<?php AuthChoice::end(); ?>
			<!--Login with FB -->
			<?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['loginregister/default/authfblogin'], 'autoRender' => false, 'popupMode' => false]); ?>
			
			<?php foreach ($authAuthChoice->getClients() as $client): ?>
			<?= Html::a( 'Login with '. $client->title, ['default/authfblogin', 'authclient'=> $client->name, ], ['class' => "btn btn-primary $client->name "]) ?>
			<?php endforeach; ?>
			
			<?php AuthChoice::end(); ?>
			<?=  '<a class="login" href='.$authreg.'><button class = "btn btn-primary">login with google</button></a> ' ?><br/><br/>
			<?=  '<a class="registration" href='.$authreg1.' ><button class = "btn btn-primary">Register with Google</button></a>' ?><br/><br/>
			<?= Html::tag('a','Click here to register with us',['href' => 'index.php?r=loginregister/default/registration',

    ])?> 

        </div>
    </div>
    
</div>
