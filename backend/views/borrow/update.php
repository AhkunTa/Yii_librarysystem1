<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Borrow */

$this->title = '修改借阅: ' . $model->borrowid;
$this->params['breadcrumbs'][] = ['label' => '借阅管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->borrowid, 'url' => ['view', 'id' => $model->borrowid]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="borrow-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
