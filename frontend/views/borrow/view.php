<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Borrow */

$this->title = $model->book->bookid;
$this->params['breadcrumbs'][] = ['label' => '我的借阅', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrow-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'borrowid',
//            'userid',
            [
                'attribute'=>'bookname',
                'label'=>'书名',
                'value'=>$model->book->bookname,
            ],
            'bookid',
            'borrowtime',
            'backtime',
            [
                'attribute'=>'ifback',
                'label'=>'是否归还',
                'value'=>$model->back->ifback,
            ],
        ],
    ]) ?>

</div>
