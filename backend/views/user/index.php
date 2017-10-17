<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--= Html::a('添加用户', ['create'], ['class' => 'btn btn-success']) -->
<!--    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'userid',
            [
                'attribute'=>'userid',
                'contentOptions'=>['width'=>'80px'],
            ],
            'username',
//            'userpassword',
            'registerdate',

            'useremail:email',
//            'reputation',
            ['class' => 'yii\grid\ActionColumn',

                'template'=>'{update} {delete}',
            ],
        ],
    ]); ?>
</div>
