<?php

namespace backend\controllers;

//use frontend\models\SignupForm;
use backend\models\ResetpwdForm;
use common\models\AuthAssignment;
use common\models\AuthItem;
use Yii;
use common\models\Admin;
use common\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\SignupForm;
use yii\web\ForbiddenHttpException;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
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
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('updateAdmin')){
            throw  new ForbiddenHttpException('对不起，你没有该操作权限，请向管理员申请。');

        }

        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
//        if(!Yii::$app->user->can('updateAdmin')){
//            throw  new ForbiddenHttpException('对不起，你没有该操作权限，请向管理员申请。');
//
//        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('createAdmin')){
            throw  new ForbiddenHttpException('对不起，你没有该操作权限，请向管理员申请。');

        }
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) ) {

            if($user = $model->signup()){
                return $this->redirect(['view','id'=>$model->adminid]);
            }
        }
        return $this->render('create',['model'=>$model]);
    }


    public function actionResetpwd($id)
    {
        if(!Yii::$app->user->can('resetPassword')){
            throw  new ForbiddenHttpException('对不起，你没有该操作权限，请向管理员申请。');

        }
        $model = new ResetpwdForm();

        if ($model->load(Yii::$app->request->post()) ) {
            if( $model->resetPassword($id)){
                return $this->redirect(['index']);
            }
        }
        return $this->render('resetpwd',['model'=>$model]);
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('updateAdmin')){
            throw  new ForbiddenHttpException('对不起，你没有该操作权限，请向管理员申请。');

        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->adminid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('createAdmin')){
            throw  new ForbiddenHttpException('对不起，你没有该操作权限，请向管理员申请。');

        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPrivilege($id){

//        $model = $this->findModel($id);

        //把所有权限提供给checkbox
        $allPrivileges = AuthItem::find()->select(['name','description'])
            ->where(['type'=>1])->orderBy('description')->all();

        foreach ($allPrivileges as $pri)
        {
            $allPrivilegesArray[$pri->name] = $pri->description;
        }
        //当前用户的权限
        $AuthAssignments = AuthAssignment::find()->select(['item_name'])
        ->where(['user_id'=>$id])->all();

        $AuthAssignmentsArray = array();
        foreach($AuthAssignments as $AuthAssignment)
        {
            array_push($AuthAssignmentsArray,$AuthAssignment->item_name);
        }

        //更新AuthAssignment表

        if(isset($_POST['newPri'])){
            AuthAssignment::deleteAll('user_id=:id',[':id'=>$id]);

            $newPri = $_POST['newPri'];
            $arrlength = count($newPri);

            for($i=0;$i<$arrlength;$i++){
                $aPri = new AuthAssignment();
                $aPri->item_name = $newPri[$i];
                $aPri->user_id = $id;
                $aPri->created_at = time();

                $aPri->save();
            }
            return $this->redirect(['index']);
        }

        //渲染checkbox

        return $this->render('privilege',['id'=>$id,'AuthAssignmentArray'=>$AuthAssignmentsArray,
            'allPrivilegesArray'=>$allPrivilegesArray]);

    }




}
