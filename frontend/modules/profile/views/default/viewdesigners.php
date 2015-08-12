<?php
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use frontend\models\Profile;
use frontend\modules\profile\models\DesignerSocialLogin;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Designer List';
$this->params['breadcrumbs'][] = $this->title;
$script = <<< JS
$(document).ready(function(){

});
JS;
$this->registerJs($script);
?>
<div id="maindiv" style="position:absolute; width:100%">
	<?php
	    for($i = 0; $i < sizeof($designers);$i=$i+3)
			{
			$todisplay1 = 'false';
			$todisplay2 = 'false';
			$todisplay3 = 'false';
			if($i < sizeof($designers))
			{
			$todisplay1 = 'true';
			$imgpath1 = Profile::findBySql('select profile_picture from profile where user_name ="'.$designers[$i]->designer_user_name.'"')->one();
			$name1 = DesignerSocialLogin::findBySql('select designer_first_name, designer_last_name, designer_revenue from designer where designer_user_name ="'.$designers[$i]->designer_user_name.'"')->one();
			}
			
			if($i+1 < sizeof($designers))
			{
			$todisplay2 = 'true';
			$imgpath2 = Profile::findBySql('select profile_picture from profile where user_name ="'.$designers[$i+1]->designer_user_name.'"')->one();
			$name2 = DesignerSocialLogin::findBySql('select designer_first_name, designer_last_name, designer_revenue from designer where designer_user_name ="'.$designers[$i+1]->designer_user_name.'"')->one();
			}
			
			if($i+2 < sizeof($designers))
			{
			$todisplay3 = 'true';
			$imgpath3 = Profile::findBySql('select profile_picture from profile where user_name ="'.$designers[$i+2]->designer_user_name.'"')->one();
			$name3 = DesignerSocialLogin::findBySql('select designer_first_name, designer_last_name, designer_revenue from designer where designer_user_name ="'.$designers[$i+2]->designer_user_name.'"')->one();
			} ?>
			
			<div class="row row-list">
			<?php if($todisplay1 == 'true') { ?>
			<div class="col-xs-3">
			<?= Html::img($imgpath1->profile_picture,['width'=>100,'height'=>100]);?><?= "<br/>" ?>
			<a href="index.php?r=profile/default/viewprofile&username=<?= $designers[$i]->designer_user_name ?>"><p><?= $name1->designer_first_name." ".$name1->designer_last_name ?></p><p>Revenue <?= $name1->designer_revenue ?></p></a>
			</div>
			<?php } ?>
			<?php if($todisplay2 == 'true') { ?>
			<div class="col-xs-3">
			<?= Html::img($imgpath2->profile_picture,['width'=>100,'height'=>100]);?><?= "<br/>" ?>
			<a href="index.php?r=profile/default/viewprofile&username=<?= $designers[$i+1]->designer_user_name ?>"><p><?= $name2->designer_first_name." ".$name2->designer_last_name ?></p><p>Revenue <?= $name2->designer_revenue ?></a>
			</div>
			<?php } ?>
			<?php if($todisplay3 == 'true') { ?>
			<div class="col-xs-3">
			<?= Html::img($imgpath2->profile_picture,['width'=>100,'height'=>100]);?><?= "<br/>" ?>
			<a href="index.php?r=profile/default/viewprofile&username=<?= $designers[$i+2]->designer_user_name ?>"><p><?= $name3->designer_first_name." ".$name3->designer_last_name ?></p><p>Revenue <?= $name3->designer_revenue ?></a>
			</div>
			<?php } ?>
			</div>
		<?php echo "<br/>";}
		?>
		
	
</div>
