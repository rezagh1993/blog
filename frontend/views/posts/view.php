<?php
use yii\helpers\Html;
use common\widgets\CommentsWidget;
use common\models\Comments;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\models\Categories;


$this->title=Html::encode($model->title);
/*$this->params['breadcrumbs']=[
    ['label' => Html::encode($model->getPostCategories->title),'url'=> ['/categories/view','urlkey'=>$model->category->urlkey]],
    $this->title,
];*/
?>

<div id="panel panel-heading">
    <h2><?= $model->title ?></h2>
</div>
    <div class="well">

     <p><?= $model->abstract ?></p>
    <?php if ($model->content) : ?>
        <p><?=$model->content ?></p>
    <?php endif; ?>
</div>

       <div class="alert alert-warning" role="alert">
           <?php foreach (Categories::find()->orderBy('title')->where(['active'=>1,'type'=>1])->all() as $category):?>
               <p>

                   <a class="alert alert-info" role="link" style="padding: 2px; cursor: pointer;"
                      href="<?= Url::to(['categories/index','title'=>$category->title],true)?> ">
                       <?= Html::encode($category->title) ?></a>

               </p>
           <?php endforeach; ?>
       </div>


<?php
Yii::$app->formatter->locale = 'fa_IR@calendar=persian';
Yii::$app->formatter->calendar = \IntlDateFormatter::TRADITIONAL;
Yii::$app->formatter->timeZone = 'UTC';

?>
<div class="alert alert-info text-left">
    <p class="pull-right"><?php
       echo Yii::$app->formatter->asDate( ($model->update_time) , 'php:D - Y/m/d');?></p>
    <p class="pull-left"><span class="fa fa-eye fa-sm fa-fw"></span> <?= number_format($model->hits) ?></p>
    <p>&nbsp;</p>
</div>
<hr>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">پیام شما</h3>
    </div>
    <div class="panel-body">

        <?php

        $form = ActiveForm::begin([
            'action' => ['comments/index'],
            'enableClientValidation'=>false,
        ]);
        echo $form->field($comment,'name')->textInput()->label('نام');
        echo $form->field($comment,'content')->textarea()->label('پیام')
        ?>
        <input type="hidden" name="Comments[post_id]" value="<?= $model->id ?>">
        <div class="form-group">
            <?= Html::submitButton('submit',['class'=> 'btn btn-primary'])?>
        </div>
        <?php ActiveForm::end()?>

    </div>
</div>



<div class="panel panel-success">
    <div class="panel-heading">نظرات کاربران</div>
</div>
<?= CommentsWidget::widget(compact('model'))  ?>

