
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Admin */

$this->title = '权限设置：' .$id;
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$id , 'url' => ['view', 'id' =>$id]];
$this->params['breadcrumbs'][] = '权限设置';
?>
    <div class="admin-form">

        <h1><?= Html::encode($this->title) ?> </h1>

        <div class="admin-privilege-form">

        <?php $form = ActiveForm::begin(); ?>

        <?=Html::checkboxList('newPri',$AuthAssignmentArray,$allPrivilegesArray); ?>

        <div class="form-group">
            <?= Html::submitButton('设置') ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    </div>
