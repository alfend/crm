<?php

namespace app\modules\metering\controllers;

use Yii;
use yii\web\Controller;
use app\models\Response;

/**
 * Default controller for the `metering` module
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

    public function actionCreateResponse()
    {

        $id_request=Yii::$app->request->post('id_request', null);;
        $id_workers=Yii::$app->request->post('id_workers', null);;
        $type_workers=Yii::$app->request->post('type_workers', null);;
        $response = new Response();
        $response -> createResponse($id_request, $id_workers, $type_workers);
        //print($id_request. $id_workers. $type_workers);
        return $this->redirect('/metering/request');
    }

    public function actionDeleteResponse()
    {

        $id_request=Yii::$app->request->post('id_request', null);;
        $id_workers=Yii::$app->request->post('id_workers', null);;
        $type_workers=Yii::$app->request->post('type_workers', null);;
        $response = new Response();
        $response -> deleteResponse($id_request, $id_workers, $type_workers);
        return $this->redirect('/metering/request');
    }
}
