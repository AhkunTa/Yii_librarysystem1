<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\Pagination;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BorrowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '借阅管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrow-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增借阅', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            [
//                'attribute'=>'borrowid',
//                'contentOptions'=>['width'=>'80px'],
//            ],
            [
                'attribute'=>'book.bookname',
                'label'=>'书名',
            ],

            [
                'attribute'=>'bookid',
                'contentOptions'=>['width'=>'120px'],
            ],



//            [
//                'attribute'=>'userid',
//                'contentOptions'=>['width'=>'80px'],
//            ],

            [
                'attribute'=>'user.username',
                'label'=>'用户名',
                'value'=>'user.username',

            ],

            'borrowtime',
            'backtime',

//            'ifback',
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

                'template'=>'{view} {update} {delete} {approve}',
                'buttons'=>[
                    'approve'=>function($url,$model,$key){
                        $options=[
                            'title'=>Yii::t('yii','审核'),
                            'aria-label'=>Yii::t('yii','审核'),
                            'data-confirm'=>Yii::t('yii','你确定审核这条信息吗？'),
                            'data-method'=>'post',
                            'data-pjax'=>'0',];
                        return Html::a('<span class="glyphicon glyphicon-check"></span>',$url,$options);
                    }
                ],

            ],
        ],
    ]); ?>


</div>
