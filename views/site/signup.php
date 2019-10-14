<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Пожалуйста заполните следующие поля:</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'date_create')->label(false)->hiddenInput(['value' => (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s')]) ?>
            <?php //сделать для города автоопределение ?>
            <?= $form->field($model, 'id_city')->label(false)->hiddenInput(['value' => '1']) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('Email:') ?>
            <?= $form->field($model, 'tel')->textInput(['maxlength' => true])->label('Телефон:') ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Пароль:') ?>
            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true])->label('Фамилия:') ?>
            <?= $form->field($model, 'firstname')->textInput(['maxlength' => true])->label('Имя:') ?>
            <?= $form->field($model, 'secondname')->textInput(['maxlength' => true])->label('Отчество:') ?>
            <?= $form->field($model, 'birthday')->textInput()->label('Дата рождения:') ?>
            <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label('Адрес:') ?>
            <?= $form->field($model, 'status')->label(false)->hiddenInput(['value' => '0'])?>
            <?php
            //echo $form->field($model, 'uploadFile[]')->fileInput(['multiple'=>'multiple']);
            ?>
                <div class="form-group">
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>