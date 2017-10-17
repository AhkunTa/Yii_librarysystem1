<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bookid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bookstatus')->textInput() ?>

    <?= $form->field($model, 'bookname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'booktypeid')->textInput() ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bookoperid')->textInput() ?>

    <?= $form->field($model, 'bookcount')->textInput() ?>

    <?= $form->field($model, 'booktag')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bookintroduction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bookreserves')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
