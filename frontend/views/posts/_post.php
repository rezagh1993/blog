<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="panel panel-info">
 <div class="panel-heading">
 <?= Html::encode($model->title) ?>
<?php if($model->content): ?>
    <a class="btn btn-info btn-xs pull-left" href="<?= Url::to(['posts/view','title'=>$model->title],true)?> ">ادامه مطلب</a>
<?php endif; ?>
</div><!-- panel-heading -->

<div class="panel-body"><?= Html::encode($model->abstract) ?></div>
<?php
Yii::$app->formatter->locale = 'fa_IR@calendar=persian';
Yii::$app->formatter->calendar = \IntlDateFormatter::TRADITIONAL;
Yii::$app->formatter->timeZone = 'UTC';
//$value=Html::encode($post->update_time)
?>
<div class="panel-footer text-muted"><?= Yii::$app->formatter->asDate( ($model->update_time) , 'php:D - Y/m/d');?>
    <span class="pull-left">
        <span class="fa fa-eye fa-sm fa-fw"> </span>
        <?= number_format($model->hits)?>
    </span>
</div><!--panel-footer -->
</div><!-- panel-info -->
