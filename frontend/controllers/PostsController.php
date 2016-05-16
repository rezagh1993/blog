<?php

namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use common\models\Posts;
use yii\data\Pagination;
use common\models\Comments;


class PostsController extends Controller
{
  
    public function actionIndex()
    {
        $query=Posts::find();
        $query->where(['active'=> 1]);


        $pagination= new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count()
        ]);

        $models = $query->limit($pagination->limit)->offset($pagination->offset)->orderBy('id DESC')->all();

        return $this->render('index', compact('models','pagination'));
    }
    public function actionView($title)
    {
        $comment=new Comments();
        $model=Posts::findOne(['title' => $title]);
        $model->updateCounters(['hits'=>1]);
        $model->refresh();
        return $this->render('view',['model'=>$model , 'comment'=>$comment ]);

    }
    public function actionTag($tag)
    {
        $query=Posts::findAll(['tags'=>$tag,'active'=>1]);

        $pagination= new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count()
        ]);

        $models = $query->limit($pagination->limit)->offset($pagination->offset)->orderBy('id DESC')->all();

        return $this->render('index', compact('models','pagination'));
    }

}