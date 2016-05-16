<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\data\Pagination;


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'دسته بندی ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

?>
<div class="site-index" xmlns="http://www.w3.org/1999/html">
    <?php if(!$posts) : ?>
        <div class="alert alert-danger">
            <p>هیچ مطلبی یافت نشد</p>
        </div>
    <?php else: ?>
        
        <?php Pjax::begin(); ?>

        <?php foreach($posts as $post) : ?>
            <?= $this->render('view',compact('post')) ?>
        <?php endforeach; ?>
        <?= LinkPager::widget(compact('pagination')) ?>
        <?php Pjax::end(); ?>
    <?php endif; ?>
</div>
