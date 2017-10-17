<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BorrowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '我的借阅';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrow-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


//            'borrowid',
            [
                'attribute'=>'book.bookname',
                'label'=>'书名',
                'value'=>'book.bookname',
                'contentOptions'=>['width'=>'180px'],
            ],
//            'userid',
            'bookid',
            'borrowtime',
            'backtime',
//             'ifback',


            [
                'attribute'=>'ifback',
                'value'=>'back.ifback',
//            'contentOptions'=>['width'=>'120px'],
                'filter'=>\common\models\back::find()
                ->select(['ifback','id'])
                ->indexBy('id')
                ->column(),
                'contentOptions'=>
                    function($model){
                        if($model->ifback==2||$model->ifback==3){
                            return ['class'=>'bg-danger'];
                        }elseif($model->ifback==1){
                            return ['class'=>'bg-warning'];
                        }else{
                            return ['class'=>'bg-info'];
                        }
                    }
            ],


            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {returnbook} {renew}',
                'buttons'=>[
                    'returnbook'=>function($url,$model,$key){
                        $options=[
                            'title'=>Yii::t('yii','还书'),
                            'aria-label'=>Yii::t('yii','还书'),
                            'data-confirm'=>Yii::t('yii','你确定归还这本书吗？'),
                            'data-method'=>'post',
                            'data-pjax'=>'0',];
                        return Html::a('<span class="glyphicon glyphicon-check"></span>',$url,$options);
                    },
                    'renew'=>function($url,$model,$key){
                        $options=[
                            'title'=>Yii::t('yii','续借'),
                            'aria-label'=>Yii::t('yii','续借'),
                            'data-confirm'=>Yii::t('yii','你确定续借这本书吗？'),
                            'data-method'=>'post',
                            'data-pjax'=>'0',];
                        return Html::a('<span class="glyphicon glyphicon-book"></span>',$url,$options);
                    }
                ],


                ],


        ],
    ]); ?>
</div>
