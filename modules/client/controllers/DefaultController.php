<?php

namespace app\modules\client\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Request;
use app\models\Response;



/**
 * Default controller for the `client` module
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

    //список откликнвшихся
    public function actionSelectMetering()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;
        $type_workers=Yii::$app->request->post('type_workers', null);;
        $response = new Response();
        $workers = $response -> findWorkers($id_request, $type_workers);
        return $this->render('viewSelectMetering', ['workers'=>$workers]);
    }

    //список откликнвшихся
    public function actionInsertMetering()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;
        $id_workers=Yii::$app->request->post('id_workers', null);;
        $date_workers=Yii::$app->request->post('date_workers', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setInsertMetering($id_request,$id_workers,$date_workers);
        $request->setStatus($id_request, Request::STATUS_METERING_BEFORE, Request::STATUS_METERING_RUN);

        return $this->redirect('/client/request/index');
    }

    public function actionSelectCompany()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;
        $type_workers=Yii::$app->request->post('type_workers', null);;
        $response = new Response();
        $workers = $response -> findWorkers($id_request, $type_workers);
        return $this->render('viewSelectCompany', ['workers'=>$workers]);
    }

    //список откликнвшихся
    public function actionInsertCompany()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;
        $id_workers=Yii::$app->request->post('id_workers', null);;
        $price=Yii::$app->request->post('price', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setInsertCompany($id_request,$id_workers,$price);
        $request->setStatus($id_request, Request::STATUS_COMPANY_BEFORE, Request::STATUS_COMPANY_RUN);
        return $this->redirect('/client/request/index');
    }

    // Подтвердить заявку что доставил
    public function actionMountingBefore()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setStatus($id_request, Request::STATUS_DELIVERY_AFTER, Request::STATUS_MOUNTING_BEFORE);
        //print_r($request);
        return $this->redirect('/client/request/index');
    }
    public function actionMountingAfter()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setStatus($id_request, Request::STATUS_MOUNTING_AFTER, Request::STATUS_FINISH);
        //print_r($request);
        return $this->redirect('/client/request/index');
    }


    public function actionSelectMounting()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;
        $type_workers=Yii::$app->request->post('type_workers', null);;
        $response = new Response();
        $workers = $response -> findWorkers($id_request, $type_workers);
        return $this->render('viewSelectMounting', ['workers'=>$workers]);
    }

    public function actionInsertMounting()
    {
        //параметры из пост
        $id_request=Yii::$app->request->post('id_request', null);;
        $id_workers=Yii::$app->request->post('id_workers', null);;
        $price=Yii::$app->request->post('price', null);;

        $request = new Request();
        $request->getRequestById($id_request);
        $request->setInsertMounting($id_request,$id_workers,$price);
        $request->setStatus($id_request, Request::STATUS_MOUNTING_BEFORE, Request::STATUS_MOUNTING_RUN);
        return $this->redirect('/client/request/index');
    }
}
