<?php
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use frontend\modules\profile\models\Baseprofileforupdate;
use frontend\modules\profile\models\Endorsement;
use kartik\switchinput\SwitchInput;
use yii\helpers\Url;
use yii\web\Session;


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
$session = new Session;
$session->open();
$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;
$script = <<< JS
$(document).ready(function(){
	
$('#profileupdatepost').hide();
$('#baseprofileupdatediv').hide();
$('#styleSlider').hide();

$('#profilepost').on( "click",function() {
	$('#profileupdatepost').fadeIn('slow');
});

$('#profilebasicinfo').on( "click",function() {
	 //$('#lightbox').fadeTo(1000, 0);
	 $('#lightbox').hide();
	 $('#baseprofileupdatediv').fadeIn('slow');
});

$('#modelprofbaseinfocancel').on( "click",function() {
	 $('#lightbox').fadeIn('slow');
	 $('#baseprofileupdatediv').hide();
});

$('#updatepostbutton').on( "click",function() {
	var updatepost = document.getElementById('profileupdateposttextinput').value;
	if(updatepost == '')
	{
		updatepost = 'About Me!';
	}
	$.ajax({
				type:'POST',	            
	            url:'index.php?r=profile/default/updateprofilepost',
			    data:'updatepost='+updatepost,
	            success:function(data) {
				document.getElementById('mypost').innerHTML = updatepost;
				$('#profileupdatepost').hide();
				},
				 error:function(jqXHR, textStatus, errorThrown){
				 alert('error::'+errorThrown);}
	         });
});

$('#mystyles').on( "click",function() {
	$('#lightbox').hide();
	$('#styleSlider').fadeIn('slow');
});

$('#modelprofbaseinfocancel').on( "click",function() {
	 $('#lightbox').fadeIn('slow');
	 $('#profileupdatepost').hide();
});

$('#w1').on('click',function() {
alert('Hi');	
});

});
JS;
$this->registerJs($script);
?>
<div id="lightbox" style="position:absolute; width:100%">
	<div class="row row-list">
	<div class="col-xs-3">
	<?php $rand = (new yii\base\Security)->generateRandomString(5);?>
	<?= Html::img($imgPath.'?dummy='.$rand,['width'=>100,'height'=>100]);?>
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	<?= $form->field($model, 'imageFile')->fileInput(); ?>
	<?= Html::submitButton('Update Profile Picture',['class'=>'btn btn-primary','id'=>'uploadButton']) ?>
	<?php ActiveForm::end() ?>
	</div>
	<div class="col-xs-3">
	<a href="#" id="profilebasicinfo">
	<h4 style="color: #000000"><?= $name->designer_first_name." ".$name->designer_last_name ?></h4>
	<h5 style="color: #000000">Lives In - <?= $prof_info->user_lives_in_city .", ".$prof_info->user_lives_in_state ?></h5>
	<h5 style="color: #000000">From - <?= $prof_info->user_from_city .", ".$prof_info->user_from_state." " ?></h5>
	</a>
	<h5 style="color: #000000">Revenue - <?= $name->designer_revenue ?></h5>
	<h5>
	<?= '<label class="control-label">Want Investment</label>' ?>
	<?= SwitchInput::widget([
    'name' => 'status_13',
    'pluginOptions' => [
        'onText' => 'Yes',
        'offText' => 'No',
		'size' => 'mini',
		]
]); ?></h5>
	</div>
	<div class="col-xs-3">
	<?php 
	$endorsementmodel = new Endorsement(['sense_of_fashion' => $endorsement->sense_of_fashion,'sense_of_style' => $endorsement->sense_of_style, 'creativity' => $endorsement->creativity, 'decisiveness' => $endorsement->decisiveness]); 
	?>
	
	<table>
	<tr>
	<td style="padding: 5px;">
	<label class="control-label" for="endorsement-decisiveness">Sense of Fashion</label>
	</td>
	<!-- Background image below can be changed but it has to have same height and width as below column-->
	<td background="uploads/siteimages/star.jpg" style="height:50px;width:80px">
	<center><b><?= $endorsement->sense_of_fashion ?></b></center>
	</td>
	</tr>
	
	<tr>
	<td style="padding: 5px;">
	<label class="control-label" for="endorsement-decisiveness">Sense of Style</label>
	</td>
	<td background="uploads/siteimages/star.jpg" style="height:50px;width:80px">
	<center><b><?= $endorsement->sense_of_style ?></b></center>
	</td>
	</tr>
	
	<tr>
	<td style="padding: 10px;">
	<label class="control-label" for="endorsement-decisiveness">Creativity</label>
	</td>
	<td background="uploads/siteimages/star.jpg" style="height:50px;width:80px">
	<center><b><?= $endorsement->creativity ?></b></center>
	</td>
	</tr>
	
	<tr>
	<td style="padding: 5px;">
	<label class="control-label" for="endorsement-decisiveness">Decisiveness</label>
	</td>
	<td background="uploads/siteimages/star.jpg" height="10" style="height:50px;width:80px">
	<center><b><?= $endorsement->decisiveness ?></b></center>
	</td>
	</tr>
	</table>
	</div>
	
	</div>
	<br/>
	<label class="control-label">My Post</label>
	<a href="#" id="profilepost"><pre style="width:85%"><h5 id="mypost"><?= $about ?></h5></pre></a>
	<div id="profileupdatepost">
	<?= $form->field($model, 'updatePost')->textArea(['id'=>'profileupdateposttextinput', 'class'=>'form-control']); ?>
	<div class="row row-list">
	<div class="col-xs-1">
	<p><?= Html::button('Post',['class'=>'btn btn-primary','id'=>'updatepostbutton']) ?></p>
	</div>
	<div class="col-xs-1">
	<?= Html::button('Cancel',['class'=>'btn btn-primary','id'=>'modelprofbaseinfocancel']) ?>
	</div>
	</div>
	</div>


<!-- View friends and watch syles buttons -->
<br/>
<div class="row row-list">
<div class="col-xs-3">
	<p><a class="btn btn-default" href="index.php?r=item/default/viewitemlist&username=<?= $session['user_name'] ?>" id="friendlist">My Items &raquo;</a></p>
</div>
<div class="col-xs-3">
	<p><a class="btn btn-default" href="#" id="mystyles">My Styles &raquo;</a></p>
</div>
</div>

</div>



<!--Basic profile Info update form-->
<div id="baseprofileupdatediv" style="background-color:white">
<?php $form = ActiveForm::begin(['id' => 'updatebasicprofinfoform', 'method' => 'post', 'action' => Url::to(['default/updatebasicprofinfo']),
'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "\n<div class=\"col-lg-1\">{label}</div>\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label']],
]) ?>


<?php $modelprofbaseinfo = new Baseprofileforupdate();?>
 <?= $form->field($modelprofbaseinfo, 'firstname')->textInput(['value' => $name->designer_first_name]); ?>
 <?= $form->field($modelprofbaseinfo, 'lastname')->textInput(['value' => $name->designer_last_name]); ?>
 <?= $form->field($modelprofbaseinfo, 'currentcity')->textInput(['value' => $prof_info->user_lives_in_city]); ?>
 <?= $form->field($modelprofbaseinfo, 'currentstate')->textInput(['value' => $prof_info->user_lives_in_state]); ?>
 <?= $form->field($modelprofbaseinfo, 'nativecity')->textInput(['value' => $prof_info->user_from_city]); ?>
 <?= $form->field($modelprofbaseinfo, 'nativestate')->textInput(['value' => $prof_info->user_from_state]); ?>
 <div class="row row-list">
 <div class="col-xs-1">
 <?= Html::submitButton('Update',['class'=>'btn btn-primary','id'=>'modelprofbaseinfoupdate']) ?>
 </div>
 <div class="col-xs-1">
 <?= Html::button('Cancel',['class'=>'btn btn-primary','id'=>'modelprofbaseinfocancel']) ?>
 </div>
 </div>	
<?php ActiveForm::end() ?>
</div>

<?php $images=['<a href="#"><img src="C:\Users\saviour\Desktop\ShivajiPark670.jpg"/></a>','<img src="C:\Users\saviour\Desktop\kkk.jpg"/>','<img src="C:\Users\saviour\Desktop\ShivajiPark670.jpg"/>']; ?>

	<div class="container" style="height:550px; width:750px" id="styleSlider">
    <div class="row clearfix">
        <div class="col-md-8 column">
            <?php echo yii\bootstrap\Carousel::widget(
            ['items'=>$images]); ?>
       </div>
   </div>
</div>
