<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\models\Request;
use app\models\Response;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //Html::a('Запись на замер', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?php

    $request_client = new Request();
    $array_request_client = $request_client->getRequestByClientAndStatus( Yii::$app->user->getId(), [$request_client::STATUS_CREATE,$request_client::STATUS_METERING_BEFORE]);

    print('<h4> Заказы на замер </h4> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request_client as $request){
        //есть ли отклики на заказ
        $response = new Response();
        print('');
        if($response->findResponseByRequest($request['id'],User::TYPE_METERING)) {
            $button_res=Html::a('Выбрать замерщика', ['/client/default/select-metering/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'], 'id_clients' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_METERING]], ['class' => 'btn btn-primary']);
        } else {
            $button_res='Откликов пока нет';
        }
        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td>'.$button_res.'</td></tr>');

    };

    //уже на замере
    $array_request_client = $request_client->getRequestByClientAndStatus( Yii::$app->user->getId(), [$request_client::STATUS_METERING_AFTER]);
    foreach ($array_request_client as $request){
        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering'].'</td><td> Замерщик выбран </td></tr>');
    };

    print('</table>');
    ?>


    <?php
    //Заказы на изготовление
    $request_client = new Request();
    $array_request_client = $request_client->getRequestByClientAndStatus( Yii::$app->user->getId(), [$request_client::STATUS_COMPANY_BEFORE]);

    print('</br><h4> Заказы на изготовление </h4> <table border="1" width="100%"> <tr><th> Дата изготовления </th><th> Адрес </th><th> Дата замера </th><th></th></tr>');
    foreach ($array_request_client as $request){
        //есть ли отклики на заказ
        $response = new Response();
        print('');
        if($response->findResponseByRequest($request['id'],User::TYPE_COMPANY)) {
            $button_res=Html::a('Выбрать изготовителя', ['/client/default/select-company/'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'], 'id_clients' => Yii::$app->user->getId(), 'type_workers' => User::TYPE_COMPANY]], ['class' => 'btn btn-primary']);
        } else {
            $button_res='Откликов пока нет';
        }
        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$request['address'].'</td>'.'<td>'.$request['date_metering_plan'].'</td><td>'.$button_res.'</td></tr>');

    };
    print('</table>');
    ?>


    </br></br></br>Все:
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'id_client',
            'date_create',
            'address',
            'date_metering_plan',
            'comment_request:ntext',

            //'address_client_street',
            //'address_client_house',
            //'address_client_room',
            //
            //'id_metering',
            //
            //'date_metering',
            //'id_delivery',
            //'price_delivery',
            //'id_mounting',
            //'price_mounting',
            //'type_price',
            //'id_company',
            //'price_company',
            //'price_request',
            //'deposit_transfer',
            //'deposit_cash',
            //'type_deposit',
            //'status_price',
            //'status_request',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
