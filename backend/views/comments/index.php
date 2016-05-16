<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Comments'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'post_id',
            [
            'attribute'=>'post_title',
            'value'=>'post.title'
        ],
            'name',
           // 'content:ntext',
            [
                'attribute'=>'content',
                'format'=>'text',
                'value'=>function($row)
                {
                    return mb_substr($row->content,0,30);
                },
            ],
            [
                'attribute' => 'active',
                'value' => function ($model) {
                    return $model->active == 1 ? 'انتشار' : 'در انتظار بررسی';
                },
            ],
            // 'create_time',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
