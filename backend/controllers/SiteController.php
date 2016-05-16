<?php
namespace backend\controllers;

use common\component\AuthorRule;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','init' ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect(['index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $create_post=$auth->createPermission('create_post');
        $create_post->description='user can access to create post';
        $auth->add($create_post);

        $view_post=$auth->createPermission('view_post');
        $view_post->description='user can access to view post';
        $auth->add($view_post);

        $update_post =$auth->createPermission('update_post');
        $update_post->description='user can access to update post';
        $auth->add($update_post);

        $delete_post =$auth->createPermission('delete_post');
        $delete_post->description='user can access to delete post';
        $auth->add($delete_post);

        $author=$auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author,$create_post);

        $admin=$auth->createRole('admin');
        $auth->add($admin);

        $auth->addChild($admin,$author);
        $auth->addChild($admin,$create_post);
        $auth->addChild($admin,$update_post);
        $auth->addChild($admin,$delete_post);


        $auth->assign($admin, 1);
        $auth->assign($author, 4);

        $rule=new AuthorRule;
        $auth->add($rule);

        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description='user can update owner post';
        $updateOwnPost->ruleName=$rule->name;
        $auth->add($updateOwnPost);

        $auth->addChild($updateOwnPost,$update_post);
        $auth->addChild($author,$updateOwnPost);

    }
}


















