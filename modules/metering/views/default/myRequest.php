<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Request;
use app\models\User;
use app\models\DataMetering;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы на замер';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <?php

    //Список заказов на замер
    $request = new Request();
    $array_request = $request->getRequestByWorkerAndStatusMetering( Yii::$app->user->getId(), [$request::STATUS_METERING_RUN,$request::STATUS_METERING_AFTER,$request::STATUS_COMPANY_BEFORE]);

    //Новые заказы', ['/metering/default/new-request']));
    if(\Yii::$app->mobileDetect->isMobile() or \Yii::$app->mobileDetect->isTablet()) {
        //для телефона
        foreach ($array_request as $request) {
            $dataMetering = new DataMetering();
            //вносил ли уже замеры
            if(!$dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())) {
                $button_res = Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/metering/data-metering/create/'], [
                    'data-method' => 'POST',
                    'data-params' => ['id_request' => $request['id'],]
                ], ['class' => 'btn btn-primary']);
            } else {
                $button_res = Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/metering/data-metering/update/'], [
                    'data-method' => 'GET',
                    'data-params' => ['id' => $dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())->id,]
                ], ['class' => 'btn btn-primary']);
            }
            print('
                <div class="media">
                    <div class="media-left">
                        <img class="mr-3" src="/web/uploads/images/mobile/item-request.jpg" >
                    </div>    
                    <div class="media-body">
                        <b>Заказ №:</b>'.$request['id'].'</br>
                        <b>Адрес:</b>'.$request['address'].'</br>
                        <b>Дата замера:</b> '.$request['date_metering_plan'].'</br>
                        <b>Стоимость:</b> '.'500'.'
                    </div>    
                    <div class="media-right">
                       </br></br>'.$button_res.'
                    </div>                        
                </div>
                </br></br>
                ');
        };

    } else {
        //для ПК
        print('<h3> Заказы на замер </h3> <table border="1" width="100%"> <tr><th> Заказ № </th><th> Адрес </th><th> Дата замера </th><th> Стоимость </th><th></th></tr>');
       foreach ($array_request as $request) {
            $dataMetering = new DataMetering();
            //вносил ли уже замеры
            if(!$dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())) {
                $button_res = Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/metering/data-metering/create/'], [
                    'data-method' => 'POST',
                    'data-params' => ['id_request' => $request['id'],]
                ], ['class' => 'btn btn-primary']);
            } else {
                $button_res = Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/metering/data-metering/update/'], [
                    'data-method' => 'POST',
                    'data-params' => ['id' => $dataMetering->cheсkDataMetering($request['id'],Yii::$app->user->getId())->id,]
                ], ['class' => 'btn btn-primary']);
            }
                print('<tr><td>' . $request['id'] . '</td>' . '<td>' . $request['address'] . '</td>' . '<td>' . $request['date_metering_plan'] . '</td><td>' . '500' . '</td><td>' . $button_res . '</td></tr>');
            }
       print('</table>');
    }

    ?>


</div>
