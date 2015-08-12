<?php
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use frontend\models\Baseprofileforupdate;
use frontend\models\Friends;
use yii\helpers\Url;
use yii\web\Session;
use kartik\rating\StarRating;
use frontend\models\Endorsement;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;
$isFriends = new Friends();
$session = new Session;
$session->open();
?>
<div id="lightbox" style="position:absolute; width:100%">
	
	<div class="row row-list">
	
		<div class="col-xs-3">
		<?= Html::img($imgPath,['width'=>100,'height'=>100]);?>
		</div>
		<div class="col-xs-3">
		<a href="#" id="profilebasicinfo">
		<h4 style="color: #000000"><?= $fname." ".$lname ?></h4>
		<h5 style="color: #000000">Lives In - <?= $prof_info->user_lives_in_city .", ".$prof_info->user_lives_in_state ?></h5>
		<h5 style="color: #000000">From - <?= $prof_info->user_from_city .", ".$prof_info->user_from_state." " ?></h5>
		</a>
		</div>
		<div class="col-xs-6">
	<?php 
	$endorsementmodel = new Endorsement(['sense_of_fasion' => $endorsement->sense_of_fasion,'sense_of_style' => $endorsement->sense_of_style, 'creativity' => $endorsement->creativity, 'decisiveness' => $endorsement->decisiveness]); ?>
	<?php $form = ActiveForm::begin() ?>
	<table>
	<tr>
	<td style="padding: 5px;">
	<label class="control-label" for="endorsement-decisiveness">Sense of Fashion</label>
	</td>
	<td>
	<?= $form->field($endorsementmodel, 'sense_of_fasion')->widget(StarRating::classname(), ['pluginOptions' => ['size'=>'xs', 'showCaption'=>false, 'readonly' => true]
	])->label(false); ?>
	</td>
	</tr>
	
	<tr>
	<td style="padding: 5px;">
	<label class="control-label" for="endorsement-decisiveness">Sense of Style</label>
	</td>
	<td>
	<?= $form->field($endorsementmodel, 'sense_of_style')->widget(StarRating::classname(), ['pluginOptions' => ['size'=>'xs', 'showCaption'=>false, 'readonly' => true]
	])->label(false); ?>
	</td>
	</tr>
	
	<tr>
	<td style="padding: 5px;">
	<label class="control-label" for="endorsement-decisiveness">Creativity</label>
	</td>
	<td>
	<?= $form->field($endorsementmodel, 'creativity')->widget(StarRating::classname(), ['pluginOptions' => ['size'=>'xs', 'showCaption'=>false, 'readonly' => true]
	])->label(false); ?>
	</td>
	</tr>
	
	<tr>
	<td style="padding: 5px;">
	<label class="control-label" for="endorsement-decisiveness">Decisiveness</label>
	</td>
	<td>
	<?= $form->field($endorsementmodel, 'decisiveness')->widget(StarRating::classname(), ['pluginOptions' => ['size'=>'xs', 'showCaption'=>false, 'readonly' => true]
	])->label(false); ?>
	</td>
	</tr>
	</table>
	<?php ActiveForm::end() ?>	
		</div>
	</div>
	<br/>
	
	<?php if($prof_info->publish_data_scope == 0) {?>
	<label class="control-label">My Post</label>
	<a href="#" id="profilepost"><pre style="width:85%"><h5 id="mypost"><?= $about ?></h5></pre></a>
	<?php }
   elseif($isFriends->isFriends($session['user_name'],$username)){
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
	<p><a class="btn btn-default" href="index.php?r=site/viewmyfriend&username=<?= $username ?>" id="friendlist">Friends &raquo;</a></p>
</div>
<div class="col-xs-3">
	<p><a class="btn btn-default" href="#" id="mystyles">Styles &raquo;</a></p>
</div>
</div>
<?php } ?>

</div>



