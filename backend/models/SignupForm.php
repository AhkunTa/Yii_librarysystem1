<?php
namespace backend\models;

use yii\base\Model;
use common\models\Admin;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $adminname;
    public $adminemail;
    public $adminpassword;
    public $password_repeat;
    public $adminid;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['adminname', 'trim'],
            ['adminname', 'required'],
            ['adminname', 'unique', 'targetClass' => '\common\models\admin', 'message' => '用户名已存在'],
            ['adminname', 'string', 'min' => 2, 'max' => 255],

            ['adminemail', 'trim'],
            ['adminemail', 'required'],
            ['adminemail', 'email'],
            ['adminemail', 'string', 'max' => 255],
            ['adminemail', 'unique', 'targetClass' => '\common\models\admin', 'message' => '邮箱地址已存在'],

            ['adminpassword', 'required'],
            ['adminpassword', 'string', 'min' => 6],
            ['adminid','required'],
            ['adminid', 'integer'],
            ['adminid', 'unique', 'targetClass' => '\common\models\admin', 'message' => '管理员编号已存在'],

            ['password_repeat','compare','compareAttribute'=>'adminpassword','message'=>'两次输入密码不一致'],
        ];
    }



    public function attributeLabels()
    {
        return [
            'adminid'=>'管理员编号',
            'adminname'=>'管理员用户名',
            'adminemail'=>'管理员邮箱',
            'adminpassword'=>'管理员密码',
            'password_repeat'=>'重输密码',

        ];
    }


    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Admin();
        $user->adminname = $this->adminname;
        $user->adminemail = $this->adminemail;
        $user->adminid = $this->adminid;

        $user->setPassword($this->adminpassword);
        $user->generateAuthKey();

//        $user->adminpassword ='123456';
//        $user->save();VarDumper::dump($user->errors);exit(0);
        return $user->save() ? $user : null;
    }
}
