<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserLogin */

$this->title = $model->user_name;
$this->params['breadcrumbs'][] = ['label' => 'User Logins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-login-view">

    <h1><?= Html::encode($this->title) ?> <?php 
    if (strcmp($checkIfUpdate,'created')==0)
    	echo 'Created Successfully';
	else if (strcmp($checkIfUpdate,'updated')==0)
		echo 'Updated Successfully';
      ?>
    
    </h1> <br/>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->user_name], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_name',
            'user_password',
            'user_type',
            'user_status',
        ],
    ]) ?>

</div>
