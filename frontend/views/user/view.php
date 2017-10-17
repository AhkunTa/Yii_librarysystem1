<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '用户信息'];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([

        'model' => $model,
        'attributes' => [
//            'userid',
            'username',
//            'userpassword',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'registerdate',
//            'reputation',
            'useremail:email',
        ],
    ]) ?>

    <p>
        <?= Html::a('重置密码', ['resetpassword', 'id' => $model->userid], ['class' => 'btn btn-success']) ?>
    </p>
</div>
