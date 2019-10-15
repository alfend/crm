<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\City;
//use app\kartik\datetime\DateTimePicker;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_client')->label(false)->hiddenInput(['value' => Yii::$app->user->getId()]) ?>

    <?= $form->field($model, 'date_create')->label(false)->hiddenInput(['value' => (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s')]) ?>

    <?php
    $city= new City();
    $city_name=$city->getCityById(Yii::$app->user->identity->id_city)->name;

    ?>

    <?= $form->field($model, 'id_city')->dropDownList([Yii::$app->user->identity->id_city => $city_name])->label('Город');?>



    <h6>Город <?=$city_name;?> установлен в ваших настройках,
        если он определен не верно просим указать город прваильно, в меню мои данные. </h6>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_metering_plan')->textInput(['value' => date('Y-m-d')]);//['value' => (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s')]) ?>
    <?php
 /*   $form->field($model, 'date')->widget(
        DatePicker::className()
    );
 /*   echo $form->field($model, 'datetime_1')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter event time ...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]);

/*      DateTimePicker::widget([
        'name' => 'datetime_10',
        'options' => ['placeholder' => 'Select operating time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'd-M-Y g:i A',
            'startDate' => '01-Mar-2014 12:00 AM',
            'todayHighlight' => true
        ]
    ]);
 */   ?>
    <?= $form->field($model, 'comment_request')->textarea(['rows' => 3]) ?>

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
