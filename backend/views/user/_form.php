<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

<!--     // $form->field($model, 'username')->textInput(['maxlength' => true]) -->

<!--    --><?//= $form->field($model, 'userpassword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registerdate')->textInput() ?>

    <?= $form->field($model, 'useremail')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
