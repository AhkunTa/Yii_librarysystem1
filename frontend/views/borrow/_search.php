<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrow-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'borrowid') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'bookid') ?>

    <?= $form->field($model, 'borrowtime') ?>

    <?= $form->field($model, 'backtime') ?>

    <?php // echo $form->field($model, 'ifback') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
