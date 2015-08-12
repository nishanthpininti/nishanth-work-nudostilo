<?php
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use frontend\models\Baseinvestorprofileforupdate;
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
	$('#baseprofileupdatediv').hide();
	$('#profilebasicinfo').on( "click",function() {
	 //$('#lightbox').fadeTo(1000, 0);
	 $('#lightbox').hide();
	 $('#baseprofileupdatediv').fadeIn('slow');
	});
	$('#modelprofbaseinfocancel').on( "click",function() {
	 $('#lightbox').fadeIn('slow');
	 $('#baseprofileupdatediv').hide();
	});
});
JS;
$this->registerJs($script);
?>
<div id="lightbox" style="position:absolute; width:100%">
	<div class="row row-list">
	<div class="col-xs-5">
	<a href="#" id="profilebasicinfo">
	<h4 style="color: #000000"><?= $name->investor_first_name." ".$name->investor_last_name ?></h4>
	</a>
	</div>
	<div class="col-xs-5">
	</div>
	</div>
	<br/>
	<p><a class="btn btn-default" href="index.php?r=site/viewdesigners&username=<?= $session['user_name'] ?>" id="designerlist">View Designers &raquo;</a></p>
</div>



<!--Basic profile Info update form-->
<div id="baseprofileupdatediv" style="background-color:white">
<?php $form = ActiveForm::begin(['id' => 'updatebasicprofinfoform', 'method' => 'post', 'action' => Url::to(['site/updateinvestorbasicprofinfo']),
'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "\n<div class=\"col-lg-1\">{label}</div>\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label']],
]) ?>


<?php $modelprofbaseinfo = new Baseinvestorprofileforupdate();?>
 <?= $form->field($modelprofbaseinfo, 'firstname')->textInput(['value' => $name->investor_first_name]); ?>
 <?= $form->field($modelprofbaseinfo, 'lastname')->textInput(['value' => $name->investor_last_name]); ?>
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
