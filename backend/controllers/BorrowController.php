<?php

namespace backend\controllers;

use Yii;
use common\models\Borrow;
use common\models\BorrowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;

/**
 * BorrowController implements the CRUD actions for Borrow model.
 */
class BorrowController extends Controller
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

//            'access'=>[
//                'class'=>AccessControl::className(),
//                'rules'=>[
//                    [
//                        'actions'=>['index','update','delete','approve'],
//                        'allow'=>false,
//                        'roles'=>['?'],
//                    ],
//                ],
//            ],
        ];
    }

    /**
     * Lists all Borrow models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('borrowController')){
            throw  new ForbiddenHttpException('对不起，你没有该操作权限，请向管理员申请。');

        }

        $borrow=Borrow::find()->all();
         IfOutTime($borrow);




        $searchModel = new BorrowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Borrow model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!Yii::$app->user->can('borrowController')){
            throw  new ForbiddenHttpException('对不起，你没有该操作权限，请向管理员申请。');

        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Borrow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('borrowController')){
            throw  new ForbiddenHttpException('对不起，你没有该操作权限，请向管理员申请。');

        }

        $model = new Borrow();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->borrowid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Borrow model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('borrowController')){
            throw  new ForbiddenHttpException('对不起，你没有该操作权限，请向管理员申请。');

        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->borrowid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Borrow model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('borrowController')){
            throw  new ForbiddenHttpException('对不起，你没有该操作权限，请向管理员申请。');

        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Borrow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Borrow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Borrow::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionApprove($id){

        $model = $this ->findModel($id);
        if($model ->approve($id)){
            return $this ->redirect(['index']);
        }
    }


}
function IfOutTime($borrow)
{
    foreach ($borrow as $obj){

        $now = date('Y-m-d', time());
        $backtime = strtotime($obj->backtime);
//        $borrowtime = strtotime($obj->borrowtime);
        if($obj->ifback ==1 ||$obj->ifback ==3){

        if ($backtime < strtotime($now)) {
            $obj->ifback = 2;
            $obj->save();
        }}
    }

}

