<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\bookstatus;
use common\models\admin;
/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bookid')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'bookname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'bookintroduction')->textInput(['maxlength' => true]) ?>

    <?php
    $psObjs = bookstatus::find()->all();
    $allstatus = \yii\helpers\ArrayHelper::map($psObjs,'id','bookstatus');

    $type = ( new \yii\db\Query())
        ->select(['type','typeid'])
        ->from('library_type')
        ->indexBy('typeid')
        ->column();

    $allAdmin = admin::find()
        ->select(['adminname','adminid'])
        ->orderBy('adminid')
        ->indexBy('adminid')
        ->column();

    //第一种
    //    $psArray = Yii::$app->db->createCommand('select id, name from bookstatus')
    //    $allstatus = \yii\helpers\ArrayHelper::map($psArray,'id','bookstatus');
    //第二
    //    $psObjs = bookstatus::find()->all();
    //    $allstatus = \yii\helpers\ArrayHelper::map($psObjs,'id','bookstatus');
    //第三种
    //    $type = ( new \yii\db\Query())
    //        ->select(['type','typeid'])
    //        ->from('library_type')
    //        ->indexBy('typeid')
    //        ->column();
    //第四种
    //    $allAdmin = admin::find()
    //        ->select(['adminname','adminid'])
    //        ->orderBy('id')
    //        ->indexBy('adminid')
    //        ->column();




    ?>
    <!--    < //= $form->field($model, 'bookstatus')
    //                            ->dropDownList([1=>'不可借',2=>'可借',3=>'待审核'],
    //                            ['prompt'=>'请选择状态：']);
    //                        >-->
    <?= $form->field($model, 'bookstatus')
        ->dropDownList($allstatus,
            ['prompt'=>'请选择状态：']);
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
