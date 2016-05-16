<?php

namespace frontend\controllers;


use common\models\Posts;
use Yii;
use yii\web\Controller;
use common\models\Comments;


class CommentsController extends Controller
{
    public function actionIndex()
    {
        $model=new Comments();
//        var_dump($model->attributes, $model->safeAttributes(), Yii::$app->request->post()); exit('12');
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->renderContent('saved');
        }else{
            var_dump($model->errors);
            return $this->renderContent('Fail');
        }

    }

    public function actionAddComment()
    {
        return $this->renderContent('saved');
    }
}