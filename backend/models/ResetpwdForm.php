<?php
namespace backend\models;

use yii\base\Model;
use common\models\Admin;
use yii\helpers\VarDumper;


class ResetpwdForm extends Model
{


    public $adminpassword;
    public $password_repeat;

    public function rules()
    {
        return [

            ['adminpassword', 'required'],
            ['adminpassword', 'string', 'min' => 6],


            ['password_repeat','compare','compareAttribute'=>'adminpassword','message'=>'两次输入密码不一致'],
        ];
    }



    public function attributeLabels()
    {
        return [

            'adminpassword'=>'管理员密码',
            'password_repeat'=>'重输密码',

        ];
    }


    public function resetPassword($id)
    {
        if (!$this->validate()) {
            return null;
        }
        $admin = Admin::findOne($id);
        $admin->setPassword($this->adminpassword);
        $admin->removePasswordResetToken();

        return $admin->save() ? true : false;
    }
}
