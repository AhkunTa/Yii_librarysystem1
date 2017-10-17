<?php

namespace frontend\controllers;

use common\models\Book;
use Yii;
use common\models\Borrow;
use frontend\models\BorrowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        ];
    }

    /**
     * Lists all Borrow models.
     * @return mixed
     */
    public function actionIndex()
    {
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->borrowid]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionReturnbook($id){

        $model = $this ->findModel($id);
        if($model ->returnBook($id)){
            return $this ->redirect(['index']);
        }
    }

    public function actionRenew($id){

        $model = $this ->findModel($id);
        if($model ->renew()){
            return $this ->redirect(['index']);
        }
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





//    public function returnbook($id){
//
//        $model = $this->findModel($id);
//        if($this ->ifback==1){
//            $this ->ifback = 3;
//            $model ->bookstatus =3 ;
//            Yii::$app->session->setFlash('success', '还书成功,请等待管理员审核。');
//        }elseif ($this ->ifback==2){
//            Yii::$app->session->setFlash('error', '您的图书已经逾期，请到管理员处办理逾期归还手续。');
//        }
//        return ($this->save()?true:false);
//    }





}
