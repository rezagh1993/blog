<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Comments */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Comments',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
