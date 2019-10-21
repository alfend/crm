<?php

namespace app\modules\delivery\controllers;

use Yii;
use yii\web\Controller;
use app\models\Request;

/**
 * Default controller for the `delivery` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    //новые заказы
    public function actionNewRequest()
    {
        return $this->render('newRequest');
    }
    //заказы мне
    public function actionMyRequest()
    {
        return $this->render('myRequest');
    }
    //мои отклики
    public function actionMyResponse()
    {
        return $this->render('myResponse');
    }

    //установить доставщиком
    public function actionInsertDelivery()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;
        $id_workers=Yii::$app->request->post('id_workers', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setInsertDelivery($id_request,$id_workers);

        return $this->redirect('/delivery/default/myRequest');
    }

    //Доставил
    public function actionDeliveryAfter()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;
        $id_workers=Yii::$app->request->post('id_workers', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setStatus($id_request, Request::STATUS_DELEVERY_BEFORE, Request::STATUS_DELEVERY_AFTER);

        return $this->redirect('/delivery/default/myRequest');
    }
}
