<?php

namespace app\modules\company\controllers;

use Yii;
use yii\web\Controller;
use app\models\Response;

/**
 * Default controller for the `company` module
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


    public function actionNewRequest()
    {
        return $this->render('newRequest');
    }

    public function actionMyRequest()
    {
        return $this->render('myRequest');
    }

    public function actionMyResponse()
    {
        return $this->render('myResponse');
    }


    public function actionCreateResponse()
    {

        $id_request=Yii::$app->request->post('id_request', null);
        $id_workers=Yii::$app->request->post('id_workers', null);
        $type_workers=Yii::$app->request->post('type_workers', null);
        $date_workers=Yii::$app->request->post('date_workers', null);
        $price=Yii::$app->request->post('price', null);

        $response = new Response();
        $response -> createResponse($id_request, $id_workers, $type_workers, $date_workers, $price);
        //print($id_request.' '.$id_workers.' '.$type_workers.' '.$date_workers.' '.$price);
        return $this->redirect('/company/default/my-request');
    }

    //удалить отклик
    public function actionDeleteResponse()
    {
        $id_request=Yii::$app->request->post('id_request', null);
        $id_workers=Yii::$app->request->post('id_workers', null);
        $type_workers=Yii::$app->request->post('type_workers', null);
        $response = new Response();
        $response -> deleteResponse($id_request, $id_workers, $type_workers);
        return $this->redirect('/company/default/new-request');
    }

}
