<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use yii\db\Exception;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $useremail;
    public $userpassword;
    public $password_repeat;
    public $userid;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名已存在.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['useremail', 'trim'],
            ['useremail', 'required'],
            ['useremail', 'email'],
            ['useremail', 'string', 'max' => 255],
            ['useremail', 'unique', 'targetClass' => '\common\models\User', 'message' => '邮箱地址已存在.'],

            ['userpassword', 'required'],
            ['userpassword', 'string', 'min' => 6],

            ['password_repeat','compare','compareAttribute'=>'userpassword','message'=>'两次输入密码不一致.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'userid'=>'用户编号',
            'username'=>'用户名',
            'useremail'=>'邮箱',
            'userpassword'=>'密码',
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
        
        $user = new User();
//        $user->userid = $this->userid;
        $user->username = $this->username;
        $user->useremail = $this->useremail;
        $user->setPassword($this->userpassword);
        $user->generateAuthKey();
        $user->registerdate=date('Y-m-d');
//        $user->userpassword ='123456';

        if(!$user->save()) throw new Exception('注册失败');
        return $user;

    }
}
