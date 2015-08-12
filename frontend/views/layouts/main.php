<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\web\Session;
use frontend\modules\loginregister\models\user_login;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
Yii::$app->homeUrl = 'index.php?r=site/index'
?>
<?php 
$script = <<< JS


$('#market').click(function(e) {
    e.preventDefault();
	$('#search').attr('data-searchtype','market');
    $(this).addClass('active');
		$('#people').removeClass('active');
})
		$('#people').click(function(e) {
		$('#search').attr('data-searchtype','people');
    e.preventDefault();
    $(this).addClass('active');
		$('#market').removeClass('active');
})
$('#search').click(function(e)
{		
		type = $(this).attr('data-searchtype');
		if(type == '')
		{
		type = 'market';
		}
e.preventDefault();
e.stopImmediatePropagation();
		
		var searchTxt = $("input[name='search']").val();
		var searchVal = 'searchV='+searchTxt;
		
		console.log(searchTxt);
		
	
		
	
 //var type = ddl.options[ddl.selectedIndex].value;
		//alert(type);
		alert(type);
if (type == "people")
{
alert('in people');
    		$.ajax({
    type: "POST",
    url: "index.php?r=search/default/user",
    data : searchVal	 ,
    success: function(output) {
		//alert(output);
     $("#output").html(output);
    }
  });
		}
		else if(type == "market")
		{
		alert('this is market');
			$.ajax({
    type: "POST",
    url: "index.php?r=search/default/items",
    data : searchVal	 ,
    success: function(output) {
		//alert(output);
     $("#output").html(output);
    }
  });
		}
		
	
}); 

JS;
$this->registerJs($script);
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
    <link type='text/css' rel='stylesheet' href='css/main.css'>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'NUDOSTILO',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse
		 navbar-fixed-top',
			    ],
            ]);
            ?>
            <div class=container-fluid>
				
				<div class="col-sm-3 col-md-3 pull-centre">
					
					
					
					<div class="input-group">
					
						<div class="input-group-btn">
							<button class="btn btn-default"  id="people"><i class="glyphicon glyphicon-user"></i></button>
							<button class="btn btn-default"  id="market"><i class="glyphicon glyphicon-gift"></i></button>
						</div>
						<form class="navbar-form" role="search" action="#" method="post" id="searchdivision" >
						<input type="text" class="form-control" placeholder="Search for people,market" name="search">
						<div class="input-group-btn">
							<button data-searchtype='' class="btn btn-default" type="submit" id="search"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
					</form>
				</div>
            
            <?php
            /*$menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            	['label' => 'My Profile', 'url' => ['/site/index']],
            	['label' => 'Inbox', 'url' => ['/site/index']],
                ['label' => 'Market', 'url' => ['/site/index']],
            	['label' => 'Log out', 'url' => ['/site/index']],
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);*/ ?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>+</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-bell"></span></a></li>
					<li><a href="index.php?r=cart/default/addcart"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
					<?php
					$session = new Session;
					$session->open();
					if (isset($session['user_name']))
					{
						$usertype = (new user_login)->getUserType($session['user_name']);
						if($usertype == 'c')
						{
						$profileURL = 'index.php?r=profile/default/mycustomerprofilepage';
						}
						else if($usertype == 'd')
						{
						$profileURL = 'index.php?r=profile/default/mydesignerprofilepage';	
						}
						else if($usertype == 'i')
						{
						$profileURL = 'index.php?r=profile/default/myinvestorprofilepage';		
						}
						else
						{
						$profileURL = '#';	
						}
					}
					else
						$profileURL = '#';
					?>
					<li><a href="<?= $profileURL ?>"><img src="<?php echo Yii::$app->request->baseUrl.'/images/try1.jpg'?>" class="profile-image img-circle"></img></a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" 	href="#">
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
						    <li><a href="index.php?r=cart/default/settings">Your Orders</a></li>
							<li><a href="index.php?r=cart/default/profilesettings">Settings</a></li>
							<li><a href="#">Privacy</a></li>
							<li><a href="index.php?r=loginregister/default/mylogout">Logout</a></li>
						</ul>
					</li>
				</ul>
            
			</div>
        <?php
            NavBar::end();
        ?>
         <div id="output" class="container">
         
        
        </div>
        	<?= $content ?>
        
       



    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
