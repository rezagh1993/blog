<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Categories */


?>
<div class="panel panel-info">
    <div class="panel-heading">
        <?= Html::encode($post->title) ?>
        <?php if($post->content): ?>
            <a class="btn btn-info btn-xs pull-left" href="<?= Url::to(['posts/view','title'=>$post->title],true)?> ">ادامه مطلب</a>
        <?php endif; ?>
    </div><!-- panel-heading -->

    <div class="panel-body"><?= Html::encode($post->abstract) ?></div>
    <?php
    Yii::$app->formatter->locale = 'fa_IR@calendar=persian';
    Yii::$app->formatter->calendar = \IntlDateFormatter::TRADITIONAL;
    Yii::$app->formatter->timeZone = 'UTC';
    ?>
    <div class="panel-footer text-muted"><?php echo Yii::$app->formatter->asDate('now', 'php:D - Y/m/d');?>
        <span class="pull-left">
                    <span class="fa fa-eye fa-sm fa-fw"> </span>
            <?= number_format($post->hits)?>
                </span>
    </div><!--panel-footer -->
</div><!-- panel-info -->
