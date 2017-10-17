<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Borrow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrow-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'bookid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'borrowtime')->textInput() ?>

    <?= $form->field($model, 'backtime')->textInput() ?>

    <?= $form->field($model, 'ifback')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
