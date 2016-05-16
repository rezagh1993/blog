<?php

namespace frontend\controllers;

use Yii;
use common\models\Categories;
use yii\web\Controller;
use yii\data\Pagination;


/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
{

   /* public function findModel($id)
    {
        if (($model = PostCategory::find()->where(['category_id'=> $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex($title)
    {
        $model = Categories::findOne(['title' => $title]);
        if ($model != null) {
            $pagination= new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $model->getPosts()->count(),
            ]);
            $posts = $model->getPosts()->limit($pagination->limit)->offset($pagination->offset)->orderBy('id DESC')->all();

         return $this->render('index', [
             'posts' => $posts ,
             'pagination' => $pagination ,
             'model'=> $model,
         ]);
    }


    }
    
}
