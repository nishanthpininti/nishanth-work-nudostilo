   
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;
//use Yii;

 ?>
   
      	 <div class="modal fade" id="editaddressModal" role="dialog">
    <div class="modal-dialog">
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Enter new Address</h3>
        </div>
        <div class="modal-body">
         <div class="form-group">
         
  <label class="text left" for="comment" >New Address</label>
  
  <?php 
  $session = Yii::$app->session;
  $session->open();
  $session['customer_name'] = 'greg chappel';

   $form1 = ActiveForm::begin(['id' => 'editmodaladdress',
  		'action'=>'index.php?r=cart/default/editmodaladdress'
  		
  ]) ?>
                
                <?= $form1->field($model3, 'customer_full_name')?>
                <?= $form1->field($model3, 'Address_line_1')?>
                <?= $form1->field($model3, 'Address_line_2')?>
                <?= $form1->field($model3, 'city')?>
                <?= $form1->field($model3, 'state')?>
                <?= $form1->field($model3, 'zip')?>
                <?= $form1->field($model3, 'country')?>
                <?= $form1->field($model3, 'phone_number')?>
                <?= $form1->field($model3, 'address_id')->hiddenInput()->label(false);?>
               
                <div class="form-group1">
                    <?= Html::submitButton('submit', ['class' => 'btn btn-warning', 'name' => 'credit-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
   
</div>
        </div>
      
      </div>
            </div>
            </div> 