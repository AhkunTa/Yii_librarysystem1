<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Book */

$this->title = '修改图书: ' . $model->bookid;
$this->params['breadcrumbs'][] = ['label' => '图书管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bookid, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
