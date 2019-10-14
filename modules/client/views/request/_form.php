<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_client')->label(false)->hiddenInput(['value' => Yii::$app->user->getId()]) ?>

    <?= $form->field($model, 'date_create')->label(false)->hiddenInput(['value' => (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s')]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_metering_plan')->textInput(['value' => date('Y-m-d H:i:s')]);//['value' => (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s')]) ?>

    <?php /* $form->field($model, 'address_client_street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_client_house')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_client_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment_request')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_metering')->textInput() ?>

    <?= $form->field($model, 'date_metering')->textInput() ?>

    <?= $form->field($model, 'id_delivery')->textInput() ?>

    <?= $form->field($model, 'price_delivery')->textInput() ?>

    <?= $form->field($model, 'id_mounting')->textInput() ?>

    <?= $form->field($model, 'price_mounting')->textInput() ?>

    <?= $form->field($model, 'type_price')->textInput() ?>

    <?= $form->field($model, 'id_company')->textInput() ?>

    <?= $form->field($model, 'price_company')->textInput() ?>

    <?= $form->field($model, 'price_request')->textInput() ?>

    <?= $form->field($model, 'deposit_transfer')->textInput() ?>

    <?= $form->field($model, 'deposit_cash')->textInput() ?>

    <?= $form->field($model, 'type_deposit')->textInput() ?>

    <?= $form->field($model, 'status_price')->textInput() */ ?>

    <?= $form->field($model, 'status_request')->label(false)->hiddenInput(['value' => '0'])   ?>

    <div class="form-group">
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
