<?php
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use frontend\modules\profile\models\Baseprofileforupdate;
use frontend\modules\profile\models\Friends;
use frontend\modules\profile\models\UserSocialLogin;
use frontend\modules\profile\models\Endorsement;
use frontend\modules\profile\models\DesignerSocialLogin;
use yii\helpers\Url;
use yii\web\Session;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;
$session = new Session;
$session->open();
$isFriends = (new Friends)->isFriends($session['user_name'],$username);
?>
<div id="lightbox" style="position:absolute; width:100%">
	
	<div class="row row-list">
	
		<div class="col-xs-3">
		<?= Html::img($imgPath,['width'=>100,'height'=>100]);?>
		</div>
		<div class="col-xs-2">
		<a href="#" id="profilebasicinfo">
		<h4 style="color: #000000"><?= $fname." ".$lname ?></h4>
		<h5 style="color: #000000">Lives In - <?= $prof_info->user_lives_in_city .", ".$prof_info->user_lives_in_state ?></h5>
		<h5 style="color: #000000">From - <?= $prof_info->user_from_city .", ".$prof_info->user_from_state." " ?></h5>
		</a>
		<?php if(!$isFriends && ((new UserSocialLogin())->getUserType($username) == 'C')){ ?>
		<p><a class="btn btn-default" href="#" id="mystyles">Add Friend &raquo;</a></p>	
		<?php } ?>
		<?php if(((new UserSocialLogin())->getUserType($username) == 'D') && ((new UserSocialLogin())->getUserType($session['user_name']) == 'I')){ 
		$revenue = (new DesignerSocialLogin)->getDesignerInfo($username);
		?>
		<h5 style="color: #000000">Revenue - <?= $revenue->designer_revenue ?></h5>	
		<?php } ?>
		</div>
		<div class="col-xs-6">
		
	<?php
	if(isset($myEvaluations)){
	//Below if to enable designers to be rated by users who have bought from the same designers
	if($myEvaluations != 'DummySetting'){
	$endorsementmodel = new Endorsement(['sense_of_fashion' => $myEvaluations->sense_of_fashion,'sense_of_style' => $myEvaluations->sense_of_style, 'creativity' => $myEvaluations->creativity, 'decisiveness' => $myEvaluations->decisiveness]); }
	$form = ActiveForm::begin() ?>
	
	<table>
	<tr>
	<td style="padding: 5px;">
	<label class="control-label" for="endorsement-decisiveness">Sense of Fashion</label>
	</td>
	<?php  if($canRate){?>
	<td>
	<input type="hidden" id="sofhidid" value="<?= $username ?>"/>
	<?= $form->field($endorsementmodel, 'sense_of_fashion')->widget(StarRating::classname(), ['pluginOptions' => ['size'=>'xs', 'showCaption'=>true],
	'pluginEvents' => ["rating.change" => "function() 
	{ 
	var rating = document.getElementById('endorsement-sense_of_fashion').value;
	var friendun = document.getElementById('sofhidid').value;
	$.ajax({
			type:'POST',	            
	        url:'index.php?r=profile/default/updateendorsement',
			data:'rating='+rating+'&friendun='+friendun+'&ratefield=sense_of_fashion',
	        success:function(data) {
			},
			error:function(jqXHR, textStatus, errorThrown){
			alert('error::'+errorThrown);}
	        });
	}
	"],])->label(false); ?>
	</td>
	<?php } ?>
	<td background="uploads/siteimages/star1.jpg" style="height:55px;width:80px">
	<center><b><?= round($endorsement->sense_of_fashion,1) ?></b></center>
	</td>
	</tr>
	
	<tr>
	<td style="padding: 5px;">
	<label class="control-label" for="endorsement-decisiveness">Sense of Style</label>
	</td>
	<?php  if($canRate){?>
	<td>
	<?= $form->field($endorsementmodel, 'sense_of_style')->widget(StarRating::classname(), ['pluginOptions' => ['size'=>'xs', 'showCaption'=>true],
	'pluginEvents' => ["rating.change" => "function() 
	{ 
	var rating = document.getElementById('endorsement-sense_of_style').value;
	var friendun = document.getElementById('sofhidid').value;
	$.ajax({
			type:'POST',	            
	        url:'index.php?r=profile/default/updateendorsement',
			data:'rating='+rating+'&friendun='+friendun+'&ratefield=sense_of_style',
	        success:function(data) {
			},
			error:function(jqXHR, textStatus, errorThrown){
			alert('error::'+errorThrown);}
	        });
	}
	"],])->label(false); ?>
	</td>
	<?php } ?>
	<td background="uploads/siteimages/star1.jpg" style="height:55px;width:80px">
	<center><b><?= round($endorsement->sense_of_style,1) ?></b></center>
	</td>
	</tr>
	
	<tr>
	<td style="padding: 5px;">
	<label class="control-label" for="endorsement-decisiveness">Creativity</label>
	</td>
	<?php  if($canRate){?>
	<td>
	<?= $form->field($endorsementmodel, 'creativity')->widget(StarRating::classname(), ['pluginOptions' => ['size'=>'xs', 'showCaption'=>true],
	'pluginEvents' => ["rating.change" => "function() 
	{ 
	var rating = document.getElementById('endorsement-creativity').value;
	var friendun = document.getElementById('sofhidid').value;
	$.ajax({
			type:'POST',	            
	        url:'index.php?r=profile/default/updateendorsement',
			data:'rating='+rating+'&friendun='+friendun+'&ratefield=creativity',
	        success:function(data) {
			},
			error:function(jqXHR, textStatus, errorThrown){
			alert('error::'+errorThrown);}
	        });
	}
	"],])->label(false); ?>
	</td>
	<?php } ?>
	<td background="uploads/siteimages/star1.jpg" style="height:55px;width:80px">
	<center><b><?= round($endorsement->creativity,1) ?></b></center>
	</td>
	</tr>
	
	<tr>
	<td style="padding: 5px;">
	<label class="control-label" for="endorsement-decisiveness">Decisiveness</label>
	</td>
	<?php  if($canRate){?>
	<td>
	<?= $form->field($endorsementmodel, 'decisiveness')->widget(StarRating::classname(), ['pluginOptions' => ['size'=>'xs', 'showCaption'=>true],
	'pluginEvents' => ["rating.change" => "function() 
	{ 
	var rating = document.getElementById('endorsement-decisiveness').value;
	var friendun = document.getElementById('sofhidid').value;
	$.ajax({
			type:'POST',	            
	        url:'index.php?r=profile/default/updateendorsement',
			data:'rating='+rating+'&friendun='+friendun+'&ratefield=decisiveness',
	        success:function(data) {
			},
			error:function(jqXHR, textStatus, errorThrown){
			alert('error::'+errorThrown);}
	        });
	}
	"],])->label(false); ?>
	</td>
	<?php } ?>
	<td background="uploads/siteimages/star1.jpg" style="height:55px;width:80px">
	<center><b><?= round($endorsement->decisiveness,1) ?></b></center>
	</td>
	</tr>
	</table>
	<?php ActiveForm::end() ?>	
	<?php }?>
		</div>
	</div>
	<br/>
	
	<?php if($prof_info->publish_data_scope == 0) {?>
	<label class="control-label">My Post</label>
	<a href="#" id="profilepost"><pre style="width:85%"><h5 id="mypost"><?= $about ?></h5></pre></a>
	<?php }
   elseif($isFriends){
	   ?>
	<label class="control-label">My Post</label>
	<a href="#" id="profilepost"><pre style="width:85%"><h5 id="mypost"><?= $about ?></h5></pre></a>
   <?php }
   else{}
 	?>
	
<!-- View friends and watch syles buttons -->
<br/>
<?php if($userlogindata->user_type == 'C') {?>
<div class="row row-list">
<div class="col-xs-3">
	<p><a class="btn btn-default" href="index.php?r=profile/default/viewmyfriend&username=<?= $username ?>" id="friendlist">Friends &raquo;</a></p>
</div>
<div class="col-xs-3">
	<p><a class="btn btn-default" href="#" id="mystyles">Styles &raquo;</a></p>
</div>
</div>
<?php } ?>

<!-- View designer's items and styles buttons -->
<?php if($userlogindata->user_type == 'D') {?>
<div class="row row-list">
<div class="col-xs-3">
	<p><a class="btn btn-default" href="index.php?r=item/default/viewitemlist&username=<?= $username ?>" id="friendlist">Items &raquo;</a></p>
</div>
<div class="col-xs-3">
	<p><a class="btn btn-default" href="#" id="mystyles">Styles &raquo;</a></p>
</div>
</div>
<?php } ?>

</div>



