<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Book */

$this->title = '新增图书';
$this->params['breadcrumbs'][] = ['label' => '图书管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="book-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'bookid')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'bookname')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'bookintroduction')->textInput(['maxlength' => true]) ?>

        <?php
        $psObjs = \common\models\bookstatus::find()->all();
        $allstatus = \yii\helpers\ArrayHelper::map($psObjs,'id','bookstatus');

        $type = ( new \yii\db\Query())
            ->select(['type','typeid'])
            ->from('library_type')
            ->indexBy('typeid')
            ->column();

        $allAdmin = \common\models\admin::find()
            ->select(['adminname','adminid'])
            ->orderBy('adminid')
            ->indexBy('adminid')
            ->column();
        ?>


        <?= $form->field($model, 'booktypeid')
            ->dropDownList($type,
                ['prompt'=>'请选择类型：']);
        ?>


        <?= $form->field($model, 'bookoperid')
            ->dropDownList($allAdmin,
                ['prompt'=>'请选择：']);
        ?>

        <?= $form->field($model, 'booktag')->textInput(['maxlength' => true]) ?>


        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
