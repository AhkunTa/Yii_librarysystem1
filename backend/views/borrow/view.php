<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Borrow */

$this->title = $model->borrowid;
$this->params['breadcrumbs'][] = ['label' => '借阅管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrow-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->borrowid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->borrowid], [
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
        'borrowid',
        'userid',
        'bookid',
        'borrowtime',
//        [
//                'attribute'=>'borrowtime',
//            'value'=>date('Y-m-d H:i:s',$model->borrowtime),
//        ],
        'backtime',
        'ifback',
    ],
    ]) ?>

</div>
