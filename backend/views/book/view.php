<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Book */

$this->title = $model->bookid;
$this->params['breadcrumbs'][] = ['label' => '图书管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'id',
            'bookid',
//            'bookstatus',
            [
                'attribute'=>'bookstatus',
//              'label'=>'',
                'value'=>$model->status->bookstatus,
            ],
            'bookname',
//            'booktypeid',
            [
                'attribute'=>'booktypeid',
//              'label'=>'图书类型',
                'value'=>$model->booktype->type,
            ],
            'author',
//            'bookoperid',
            [
                'attribute'=>'bookoperid',
//                'label'=>'',
                'value'=>$model->adminuser->adminname,
            ],
            'bookcount',
            'booktag',
            'bookintroduction',
//            'bookreserves',
        ],
        'template'=>'<tr><th style="width: 120px;">{label}</th><td>{value}</td></tr>',
        'options'=>['class'=>'table table-striped table-border detail-view'],

    ]) ?>
</div>
