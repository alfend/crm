<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Request;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы на доставку';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    //Вывод заказов
    $request = new Request();
    $array_request = $request->getRequestByStatus( Yii::$app->user->identity->id_city, $request::STATUS_DELEVERY_BEFORE);

    print('<h3> Заказы на доставку </h3> <table border="1" width="100%"> <tr><th> Дата создания </th><th> Адрес отправки </th><th> Адрес доставки </th><th></th></tr>');
    foreach ($array_request as $request){

        //вносил ли уже замеры
        $button_res=Html::a('Доставил', ['/delivery/default/delivery-after'],['data-method' => 'POST', 'data-params' => ['id_request' => $request['id'],'id_workers' => Yii::$app->user->getId()]], ['class' => 'btn btn-primary']);
        $company = new User();
        $company = User::findIdentity($request['id_company']);
        print('<tr><td>'.$request['date_create'].'</td>'.'<td>'.$company['address_delivery'].'</td>'.'<td>'.$request['address'].'</td><td> '.$button_res.'</td></tr>');


    };

    print('</table>');
    //<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQAAFs3i44MUDnMUgaU8irASQp_72gl80"></script>
    ?>


    

</div>
