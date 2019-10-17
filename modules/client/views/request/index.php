<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Request;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Запись на замер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php

    $request_client = new Request();
    $array_request_client = $request_client->getRequestByClientAndStatus( Yii::$app->user->getId(), $request_client::STATUS_CREATE);

    print('<h3> Заказы на замер </h3> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес </th><th> Дата замера </th></tr>');
    foreach ($array_request_client as $request_client){

        print('<tr><td>'.$request_client['date_create'].'</td>'.'<td>'.$request_client['address'].'</td>'.'<td>'.$request_client['date_metering_plan'].'</td></tr>');

//        print_r($request_client['address']);
    };

    print('<table>');


    // echo $this->render('_search', ['model' => $searchModel]); ?>

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
