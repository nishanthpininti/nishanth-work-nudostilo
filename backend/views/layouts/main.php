<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

Yii::$app->homeUrl = 'index.php?r=admin/index';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'NudoStilo Admin',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/admin/index']],
            	//['label' => 'User Login Table', 'url' => ['/userlogin/index']],
            	//['label' => 'Customer Table', 'url' => ['/customer/index']],
                //['label' => 'Designer Table', 'url' => ['/designer/index']],
                //['label' => 'Investor Table', 'url' => ['/investor/index']],
            ];
        /*    if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            } */
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>
 
        <div class="container">
        
            <div class = 'navbar navbar-default' role='navigation'>
      <div class='container'>
        <div class ='navbar-header'>
          <button type ='button' class='navbar-toggle' data-toggle='collapse' data-target = '.navbar-collapse'>
           
          </button>
          
          <a class='navbar-brand'>Edit Database</a>
        </div>
        <div class = 'navbar-collapse collapse'>
         <ul class='nav navbar-nav navbar-center'>
            <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>Users<b class ='caret'></b></a>
             <ul class='dropdown-menu'>
              <li class='dropdown-header'> User Tables </li>
              <li>
               <?= Html::tag('a','User Login',[
      'href' => 'index.php?r=userlogin/index',
    ])?>
               </li>
                        <li>
               <?= Html::tag('a','Customer Master',[
      'href' => 'index.php?r=customer/index',
    ])?>
               </li>
                               <li>
               <?= Html::tag('a','Designer Master',[
      'href' => 'index.php?r=designer/index',
    ])?>
               </li>
                               <li>
               <?= Html::tag('a','Investor Master',[
      'href' => 'index.php?r=investor/index',
    ])?>
               </li>
             </ul>
            </li>
            <li class='dropdown'> <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Styles<b class ='caret'></b></a>
             
              <ul class='dropdown-menu'>
              <li class='dropdown-header'> Stye Tables </li>
              <li>
               <?= Html::tag('a','Styles',[
      'href' => 'index.php?r=styles/index',
    ])?>
               </li>
                        <li>
               <?= Html::tag('a','Style Me',[
      'href' => 'index.php?r=styleme/index',
    ])?>
               </li>
                               <li>
               <?= Html::tag('a','Share',[
      'href' => 'index.php?r=share/index',
    ])?>
               </li>
                               <li>
               <?= Html::tag('a','Send',[
      'href' => 'index.php?r=send/index',
    ])?>
               </li>
             </ul>
             
            </li> 
         </ul>
        </div>
      </div>
     </div>
     
     
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
