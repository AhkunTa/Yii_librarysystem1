<?php

namespace common\models;
use common\models\user;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "library_borrow".
 *
 * @property integer $borrowid
 * @property integer $userid
 * @property string $bookid
 * @property string $borrowtime
 * @property string $backtime
 * @property integer $ifback
 *
 * @property User $user
 * @property Book $book
 */
class Borrow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


    public static function tableName()
    {
        return 'library_borrow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'bookid', 'borrowtime', 'backtime'], 'required'],
            [['userid', 'ifback', 'renewtime'], 'integer'],
            [['userid', 'bookid','borrowtime', 'backtime','renewtime'], 'safe'],
            [['bookid'], 'string', 'max' => 128],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'userid']],
            [['bookid'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['bookid' => 'bookid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
//            'borrowid' => '',
            'userid' => '用户编号',
            'bookid' => '索书号',
            'borrowtime' => '借阅时间',
            'backtime' => '还书时间',
            'ifback' => '是否归还',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userid' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['bookid' => 'bookid']);
    }

    public function getBack()
    {
        return $this->hasOne(back::className(), ['id' => 'ifback']);
    }
//获取审核数目
    public static function getShengheCount(){
        return Borrow::find()->where(['or',['ifback'=>2],['ifback'=>3]])->count();
    }

    //审核函数
    public function approve(){
        if( $this ->ifback==1||$this ->ifback==2||$this ->ifback==3)
        {

            $this ->ifback = 0;
        }
        return ($this->save()?true:false);
    }


    public function returnbook($id){

        $model = Book::find()->where(['bookid'=>$this->bookid])->one();


        if($this ->ifback==1){
            $this ->ifback = 3;

            $model->bookstatus =3;
            $model->save();
            Yii::$app->session->setFlash('success', '还书成功,请等待管理员审核。');
        }elseif ($this ->ifback==2){
            Yii::$app->session->setFlash('error', '您的图书已经逾期，请到管理员处办理逾期归还手续。');
        }
        return ($this->save()?true:false);
    }


// $borrowtimes =1;
    public function renew(){
        if ($this->ifback==1 ){
            if($this->renewtime < 1){
                $backtime =$this ->backtime;
                $this->renewtime ++ ;
                $this->backtime = date('Y-m-d',strtotime('+1 months',strtotime($backtime)));
                Yii::$app->session->setFlash('success', '续借成功');
            }else{
                Yii::$app->session->setFlash('error', '超过最大借阅次数');
            }
        }elseif($this ->ifback==2){
            Yii::$app->session->setFlash('error', '您的图书已经逾期，请到管理员处办理逾期归还手续。');
        }elseif ($this->ifback==3){
            Yii::$app->session->setFlash('error', '等待管理员审核后才可借阅。');
        }
        return ($this->save()?true:false);
    }


}









