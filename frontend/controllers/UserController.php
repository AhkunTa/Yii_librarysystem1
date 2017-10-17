<?php

namespace frontend\controllers;

use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionMyInfo(){
//        return $this->render('view',['userid'=>$userid]);
    }


    public function actionView()
    {
        $userid=Yii::$app->session->get('userid');
//
        return $this->render('view', [
            'model' => $this->findModel($userid),
        ]);
    }


    public function actionResetpassword($id)
    {
        $model = new ResetPasswordForm();

        if ($model->load(Yii::$app->request->post()) ) {

            if( $model->resetpassword($id)){
                return $this->redirect(['site/login']);
            }
        }
        return $this->render('resetPassword',['model'=>$model]);

    }



    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
