<?php
use yii\helpers\Html;
use yii\grid\GridView;
use frontend\components\TagsCloudWidget;
use common\models\Borrow;
use yii\helpers\HtmlPurifier;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '书籍信息';
?>
<div class="container" >

    <div class="row">

        <div class="col-md-8">

            <ol class="breadcrumb">
                <li><a href="<?=Yii::$app->homeUrl;?>">首页</a></li>
                <li><a href="<?=Yii::$app->urlManager->createUrl(['book/index'])?>">图书列表</a></li>
<!--                <li><a href="--><?//=Yii::$app->homeUrl;?><!--?r=book/index">图书列表</a></li>-->
                <li class="active"><?= $model->bookname ?></li>
            </ol>

            <h1>
              <?= Html::encode($model->bookname);?>
            </h1>
            <div class="author_typ_tag">

                <span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?=Html::encode($model->author)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>

                <span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span><em><?=Html::encode( $model->booktype->type)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>

                <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                <?= implode('，',$model->tagLinks); ?>


            </div>
            <br>
            <div class="bookintroduction">
            <?= HTMLPurifier::process($model->bookintroduction) ?>
            </div>
            <br>
            <div class="bookCount">
                索书号：<?=Html::encode( $model->bookid);?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;借阅状态： <?=Html::a(" {$model->status->bookstatus}",$model->url.'#borrows');?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=Html::encode("借阅次数:{$model->bookCount}")?>

            </div>
            <br>

            <div class="borrow-form">
                <?php $form = ActiveForm::begin([
                    'method'=>'post',
                ]); ?>

                <input name="bookid" value="<?=$model->bookid ?>"type="hidden" >
                <input name="userid" value="<?=\Yii::$app->user->id ?>" type="hidden">
                <div class="form-group">
                    <?= Html::submitButton('借阅', ['class' =>'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
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
        </div>


    </div>

</div>