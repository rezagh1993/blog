<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Categories;
use common\models\Links;

AppAsset::register($this);
Yii::$app->urlManager;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => 'وبلاگ نقطه',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'صفحه اصلی', 'url' => ['/site/index']],
    ];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'ورود', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'بخش مدیریت', 'url' => ['/site/admin-panel']];
        $menuItems[] = '<li>'
           . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '(خروج ' . Yii::$app->user->identity->name . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">

        <?= Alert::widget() ?>
        <div class="row">

            <div class="col-sm-3">
              <?php  if (!Yii::$app->user->isGuest) : ?>
                <div class="panel panel-primary">

                   

                    <div class="panel-heading">مدیریت</div>

                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item"><?= Html::a('دسته بندی ها',['categories/index']) ?></li>
                            <li class="list-group-item"><?= Html::a('پست ها',['posts/index']) ?></li>
                            <li class="list-group-item"><?= Html::a('دیدگاه ها',['comments/index']) ?></li>
                            <li class="list-group-item"><?= Html::a('کاربران',['users/index']) ?></li>

                        </ul>
                        </div>


                </div><!-- panel primary -->
            <?php endif; ?>

            </div>
                <div class="col-sm-9">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= $content ?>
                </div>

            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-right">&copy; وبلاگ نقطه  <?= date('Y') ?></p>

        <p class="pull-left"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
