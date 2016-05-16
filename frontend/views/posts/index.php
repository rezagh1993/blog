<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'وبلاگ نقطه';
?>
<div class="site-index" xmlns="http://www.w3.org/1999/html">
    <?php if(!$models) : ?>
    <div class="alert alert-danger">
       <p>هیچ مطلبی یافت نشد</p>
    </div>
    <?php else: ?>
        <?php Pjax::begin(); ?>

        <?php foreach($models as $model) : ?>
            <?= $this->render('_post',compact('model')) ?>
    <?php endforeach; ?>
        <?= LinkPager::widget(compact('pagination')) ?>
        <?php Pjax::end(); ?>
    <?php endif; ?>
</div>
