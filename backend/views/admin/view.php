<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Admin */

$this->title = $model->adminname;
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->adminid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->adminid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除这条数据？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'adminid',
            'adminname',
//            'adminpassword',
            'adminemail:email',
        ],
    ]) ?>

</div>
