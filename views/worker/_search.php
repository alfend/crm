<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WorkerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="worker-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'date_create') ?>

    <?= $form->field($model, 'id_city') ?>

    <?= $form->field($model, 'lastname') ?>

    <?php // echo $form->field($model, 'firstname') ?>

    <?php // echo $form->field($model, 'secondname') ?>

    <?php // echo $form->field($model, 'organization') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'sys_notice') ?>

    <?php // echo $form->field($model, 'news_notice') ?>

    <?php // echo $form->field($model, 'id_requisite') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'commission') ?>

    <?php // echo $form->field($model, 'coefficient') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
