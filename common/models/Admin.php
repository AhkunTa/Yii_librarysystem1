<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;


/**
 * This is the model class for table "library_admin".
 *
 * @property integer $adminid
 * @property string $adminname
 * @property string $adminpassword
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $adminemail
 *
 * @property Book[] $libraryBooks
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'library_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adminid', 'adminname', 'adminemail', 'auth_key', 'password_hash', ], 'required'],
            [['adminid'], 'integer'],
            [['adminname'], 'string', 'max' => 20],
//            [['adminpassword'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['adminemail'], 'string', 'max' => 128],
            [['adminname'], 'unique'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
             return [
//                 'id' => '编号',
                 'adminid' => '管理员编号',
                 'adminname' => '用户名',
                 'adminpassword' => '密码',
                 'auth_key' => 'Auth Key',
                 'password_hash' => 'Password Hash',
                 'password_reset_token' => 'Password Reset Token',
                 'adminemail' => '电子邮箱',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLibraryBooks()
    {
        return $this->hasMany(Book::className(), ['bookoperid' => 'adminid']);
    }



    public static function findIdentity($id)
    {
        return static::findOne(['adminid' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['adminname' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,

        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


}
