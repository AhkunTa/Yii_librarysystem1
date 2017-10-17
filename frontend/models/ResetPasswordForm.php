<?php
namespace frontend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $userpassword;
    public $password_repeat;

    /**
     * @var \common\models\User
     */
//    private $_user;

    public function rules()
    {
        return [

            ['userpassword', 'required'],
            ['userpassword', 'string', 'min' => 6],


            ['password_repeat','compare','compareAttribute'=>'userpassword','message'=>'两次输入密码不一致'],
        ];
    }



    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
//    public function __construct($token, $config = [])
//    {
//        if (empty($token) || !is_string($token)) {
//            throw new InvalidParamException('密码不能为空.');
//        }
//        $this->_user = User::findByPasswordResetToken($token);
//        if (!$this->_user) {
//            throw new InvalidParamException('密码.');
//        }
//        parent::__construct($config);
//    }



    public function attributeLabels()
    {
        return [

            'userpassword'=>'用户密码',
            'password_repeat'=>'重输密码',

        ];
    }


    public function resetPassword($id)
    {

        if (!$this->validate()) {
            return null;
        }
        $user = User::findOne($id);

        $user->setPassword($this->userpassword);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
