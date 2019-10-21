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

        return $this->redirect('/client/request/index');

    }
}
