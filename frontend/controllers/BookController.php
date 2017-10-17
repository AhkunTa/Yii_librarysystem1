<?php

namespace frontend\controllers;

use common\models\Borrow;
use common\models\Tags;
use Faker\Provider\DateTime;
use phpDocumentor\Reflection\DocBlock\Tag;
use Yii;
use common\models\Book;
use common\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
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


        $tags = Tags::findTagWeights();
//        $hottestBorrow = Book::findHottestBorrow();
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tags'=>$tags,
//            'hottestBorrow'=>$hottestBorrow,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
                return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionDetail($id){


        $model = $this->findModel($id);
        $tags = Tags::findTagWeights();
//        $hottestBorrow=book::findHottestBorrow();
        $bookModel =new Book();
        $bookModel->find()->where(['id'=>$id])->one();

        if(isset($_POST['bookid']) && isset($_POST['userid'] ))
        {
            $borrow = new Borrow();
            $borrow->userid = $_POST['userid'];
            $borrow->bookid = $_POST['bookid'];

            $borrowtime= date("Y-m-d");
            $backtime = date("Y-m-d",strtotime('+1 months',strtotime($borrowtime)));

            $borrow->borrowtime = $borrowtime;
            $borrow->backtime = $backtime;

            if ($model->bookstatus == 1 && $borrow->save()) {
                $borrow->ifback = 1;
                $model->bookstatus = 2 ;
                $model->bookcount= $model->bookcount +1;
                $model->save();
//              var_dump($model->bookcount);exit();
                Yii::$app->session->setFlash('success', '借书成功');
            } else {
                Yii::$app->session->setFlash('error', '借书失败！');
            }
        }



        return $this->render('detail',
                [
                    'model'=>$model,
                    'tags'=>$tags,
                    'bookModel'=>$bookModel,
//                    'hottestBorrow'=>$hottestBorrow,
                ]);

    }
}
