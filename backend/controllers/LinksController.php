<?php

namespace backend\controllers;


use Yii;
use yii\web\Controller;


class LinksController extends Controller
{
    public function actionIndex()
    {
        return $this->renderContent('ok');
    }
}