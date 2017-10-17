<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Borrow */

$this->title = '新增借阅';
$this->params['breadcrumbs'][] = ['label' => '借阅管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrow-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'bookid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'borrowtime')->textInput() ?>

    <?= $form->field($model, 'backtime')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

