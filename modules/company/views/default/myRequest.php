<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Request;
use app\models\User;
use app\models\DataMetering;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы на изготовление';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    //Вывод заказов
    $request = new Request();
    $array_request = $request->getRequestByStatus( Yii::$app->user->identity->id_city, $request::STATUS_COMPANY_AFTER);

    print('<h3> Заказы на изготовление </h3> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request as $request){

        $dataMetering = new DataMetering();
        //вносил ли уже замеры
        if(!$dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())) {
            $button_res=Html::a('Ввести замер', ['/company/data-metering/create'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id']]], ['class' => 'btn btn-primary']);
        } else {
            $button_res=Html::a('Изменить замер', ['/company/data-metering/update', 'id' => $dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())->id],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id']]], ['class' => 'btn btn-primary']);
        }



        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td> '.$button_res.'</td></tr>');
    };

    print('</table>');

    ?>

</div>
