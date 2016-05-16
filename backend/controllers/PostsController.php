<?php

namespace backend\controllers;

use common\models\Categories;
use common\models\PostCategory;
use Yii;
use common\models\Posts;
use common\models\PostsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'delete', 'view','create'],
                'rules' => [
                    //[
                    //    'actions' => ['create', 'update','delete','view','index' ],
                    //    'allow' => true,
                    //],
                    [
                        'actions' => ['update','delete','index','view'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['create','view','index'],
                        'allow' => true,
                        'roles' => ['author'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single Posts model.
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
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Posts();
        $model->user_id = Yii::$app->user->id;

      
        
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                /*$tagStr=$model->tags;
                $tagArr = explode(",", $tagStr);

                foreach ($tagArr as $v) {
                    $tag = new Categories();
                    $tag->title=$v;
                    $tag->type = 1;
                    $tag->active = 1;
                    if (!$tag->findOne(['title'=>$v])){
                    $tag->save();
                    } }*/
                $selectTag=$model->selectTags;
                $this->tags=$selectTag;
                $model->save();
                var_dump($selectTag);exit();

                return $this->redirect(['view', 'id' => $model->id]);
               
            } else {

                return $this->render('create', [
                    'model' => $model,

                ]);
            }

    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
     
    }
    

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
