<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'ورود به پنل ادمین';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="alert alert-success">
        <h1><span class="fa fa-sign-in fa-lg fa-fw"></span><?= Html::encode($this->title) ?></h1>

        <p>لطفا فیلدها را تکمیل کنید :</p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    <span>اگر کلمه عبور خود را فراموش کرده اید : </span> <?= Html::a('ایجاد کلمه عبور جدید', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('ورود', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div><!-- alert -->
</div>
