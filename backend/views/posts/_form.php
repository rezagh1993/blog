<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PostCategory;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abstract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'selectCategory')->checkboxList($model->getAllCategory()) ?>
    <?php if ($model->isNewRecord != 1) : ?>
    <div><strong>selected tags </strong></div><?=$model->tags; ?><br><br>
    <?php endif; ?>
    <?= $form->field($model, 'selectTags')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
    </div>

    <?php ActiveForm::end(); ?>
</div>