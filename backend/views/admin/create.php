<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Admin */

$this->title = '添加管理员';
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'adminid')->textInput() ?>

    <?= $form->field($model, 'adminname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adminpassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adminemail')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton( '添加' , ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
</div>
