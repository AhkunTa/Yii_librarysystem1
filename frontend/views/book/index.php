<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = '1';
//$this->params['breadcrumbs'][] = $this->title;
$this->title = '图书管理前台系统';
?>
<div class="container" >

    <div class="row">

        <div class="col-md-8">

            <ol class="breadcrumb">
            <li>
                <a href="<?=Yii::$app->homeUrl ?>">首页</a></li>
                <li>图书列表</li>

            </ol>

            <?= \yii\widgets\ListView::widget([
                'id'=>'postList',
                'dataProvider'=>$dataProvider,
                'itemView'=>'_listitem',
                'layout'=>'{items} {pager}',

                'pager'=>[
                    'maxButtonCount'=>5,
                    'nextPageLabel'=>Yii::t('app','下一页'),
                    'prevPageLabel'=>Yii::t('app','上一页'),
                ],
            ])
            ?>

        </div>


        <div class="col-md-4">

            <div class="searchBox">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>搜索图书
                </li>
                <li class="list-group-item">

                    <form class="form-inline" action="index.php?r=post/index" id="search1" method="get">
                        <div class="form-group">

                            <input type="text" class="form-control" name="BookSearch[bookname]" id="searchinput1" placeholder="按书名搜素" style="width: 250px">
                        </div>
                        <button type="submit" class="btn btn-default">搜索</button>
                    </form>

                </li>
             </div>


            <div class="searchBox">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>搜索图书
                </li>
                <li class="list-group-item">

                    <form class="form-inline" action="index.php?r=post/index" id="search2" method="get">
                        <div class="form-group">

                            <input type="text" class="form-control" name="BookSearch[author]" id="searchinput2" placeholder="按作者搜素" style="width: 250px">
                        </div>
                        <button type="submit" class="btn btn-default">搜索</button>
                    </form>


                </li>
             </div>




            <div class="searchBox">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>热门标签
                </li>
                <li class="list-group-item">
                    <?=\frontend\components\TagsCloudWidget::widget(['tags'=>$tags]) ?>
                </li>
             </div>


<!--            <div class="searchBox">-->
<!--            <ul class="list-group">-->
<!--                <li class="list-group-item">-->
<!--                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>最热借阅-->
<!--                </li>-->
<!--                <li class="list-group-item">-->
<!--
<!--                </li>-->
<!--             </div>-->



        </div>


    </div>

</div>
