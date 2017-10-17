<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Admin */

$this->title = '修改管理员：' .$model->adminname;
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->adminname, 'url' => ['view', 'id' => $model->adminid]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="admin-update">



        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'adminname')->textInput(['maxlength' => true]) ?>


        <?= $form->field($model, 'adminemail')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


