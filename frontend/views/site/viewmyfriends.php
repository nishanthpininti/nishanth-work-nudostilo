<?php
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use frontend\models\Profile;
use frontend\models\CustomerSocialLogin;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'My Friend List';
$this->params['breadcrumbs'][] = $this->title;
$script = <<< JS
$(document).ready(function(){

});
JS;
$this->registerJs($script);
?>
<div id="maindiv" style="position:absolute; width:100%">
	<?php
	    for($i = 0; $i < sizeof($myfriends);$i=$i+3)
			{
			$todisplay1 = 'false';
			$todisplay2 = 'false';
			$todisplay3 = 'false';
			if($i < sizeof($myfriends))
			{
			$todisplay1 = 'true';
			$imgpath1 = Profile::findBySql('select profile_picture from profile where user_name ="'.$myfriends[$i]->customer_user_name2.'"')->one();
			$name1 = CustomerSocialLogin::findBySql('select customer_first_name, customer_last_name from customer where customer_user_name ="'.$myfriends[$i]->customer_user_name2.'"')->one();
			}
			
			if($i+1 < sizeof($myfriends))
			{
			$todisplay2 = 'true';
			$imgpath2 = Profile::findBySql('select profile_picture from profile where user_name ="'.$myfriends[$i+1]->customer_user_name2.'"')->one();
			$name2 = CustomerSocialLogin::findBySql('select customer_first_name, customer_last_name from customer where customer_user_name ="'.$myfriends[$i+1]->customer_user_name2.'"')->one();
			}
			
			if($i+2 < sizeof($myfriends))
			{
			$todisplay3 = 'true';
			$imgpath3 = Profile::findBySql('select profile_picture from profile where user_name ="'.$myfriends[$i+2]->customer_user_name2.'"')->one();
			$name3 = CustomerSocialLogin::findBySql('select customer_first_name, customer_last_name from customer where customer_user_name ="'.$myfriends[$i+2]->customer_user_name2.'"')->one();
			} ?>
			
			<div class="row row-list">
			<?php if($todisplay1 == 'true') { ?>
			<div class="col-xs-3">
			<?= Html::img($imgpath1->profile_picture,['width'=>100,'height'=>100]);?><?= "<br/>" ?>
			<a href="index.php?r=site/viewprofile&username=<?= $myfriends[$i]->customer_user_name2 ?>"><p><?= $name1->customer_first_name." ".$name1->customer_last_name ?></p></a>
			</div>
			<?php } ?>
			<?php if($todisplay2 == 'true') { ?>
			<div class="col-xs-3">
			<?= Html::img($imgpath2->profile_picture,['width'=>100,'height'=>100]);?><?= "<br/>" ?>
			<a href="index.php?r=site/viewprofile&username=<?= $myfriends[$i+1]->customer_user_name2 ?>"><p><?= $name2->customer_first_name." ".$name2->customer_last_name ?></p></a>
			</div>
			<?php } ?>
			<?php if($todisplay3 == 'true') { ?>
			<div class="col-xs-3">
			<?= Html::img($imgpath2->profile_picture,['width'=>100,'height'=>100]);?><?= "<br/>" ?>
			<a href="index.php?r=site/viewprofile&username=<?= $myfriends[$i+2]->customer_user_name2 ?>"><p><?= $name3->customer_first_name." ".$name3->customer_last_name ?></p></a>
			</div>
			<?php } ?>
			</div>
		<?php echo "<br/>";}
		?>
		
	
</div>
