<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Posts'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'user_name',
                'value'=> 'user.name'
            ],
            'title',
            //'abstract',
            [
                'attribute'=>'abstract',
                'value'=>function($row)
                {
                    return mb_substr($row->abstract,0,30);
                },
            ],
            //'content:ntext',
            [
                'attribute'=>'content',
                'format'=>'text',
                'value'=>function($row)
                {
                    return mb_substr($row->content,0,30);
                },
            ],
             'hits',
            [
                'attribute' => 'active',
                'value' => function ($model) {
                    return $model->active == 1 ? 'انتشار' : 'در انتظار بررسی';
                },
            ],
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'tags',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
