<?php
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29 0029
 * Time: 15:06
 */
?>
<div class="book" style="border-bottom: 1px solid #d616ff;">
    <div class="bookname">
        <h2>
            <a href="<?= $model->url?>"><?= Html::encode($model->bookname);?></a>
        </h2>
        <div class="author_typ_tag">

            <span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?=Html::encode($model->author)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>

            <span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span><em><?=Html::encode( $model->booktype->type)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>

            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            <?= implode('，',$model->tagLinks); ?>



        </div>
        <br>
        <div class="bookintroduction">
            <?= $model->beginning; ?>
        </div>
        <br>
        <div class="bookCount">
            索书号：<?=Html::encode( $model->bookid);?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;借阅状态： <?=Html::a(" {$model->status->bookstatus}",$model->url.'#borrows');?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=Html::encode("借阅次数:{$model->bookCount}")?>

        </div>

    </div>
</div>
