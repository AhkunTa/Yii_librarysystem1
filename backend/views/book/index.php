<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '图书管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增图书', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'bookname',

//            'bookid',
            [
                'attribute'=>'bookid',
                'contentOptions'=>['width'=>'130px'],
            ],
            //             'bookintroduction',
//            [
//                    'attribute'=>'bookintroduction',
//                    'value'=>function($model)
//                    {
//                        $tmpStr=strip_tags($model->bookintroduction);
//                        $tmpLen=mb_strlen($tmpStr);
//                        return mb_substr($tmpStr,0,15,'utf-8').(($tmpLen>15)?'...':':');
//
//                    },
//            ],


            'author',


//            'bookstatus',
            [
                'attribute'=>'booktypeid',
                'contentOptions'=>['width'=>'80px'],
                'value'=>'booktype.type',
                'filter'=>\common\models\Type::find()
                    ->select(['type','typeid'])
                    ->indexBy('typeid')
                    ->column(),
            ],

            [
                'attribute'=>'bookstatus',
                'value'=>'status.bookstatus',
                'contentOptions'=>function($model)
                {
                    if($model->bookstatus==3)
                    {
                        return ['class'=>'bg-danger'];
                    }else if($model->bookstatus==1){
                        return ['class'=>'bg-info'];
                    }else{
                        return ['class'=>'bg-warning'];
                    }
                },

                'filter'=>\common\models\Bookstatus::find()
                    ->select(['bookstatus','id'])
                    ->indexBy('id')
                    ->column(),
            ],

            // 'bookoperid',
            // 'bookcount',
            // 'booktag',
            // 'bookreserves',
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
