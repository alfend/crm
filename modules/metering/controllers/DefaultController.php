<?php

namespace app\modules\metering\controllers;

use Yii;
use yii\web\Controller;
use app\models\Response;
use app\models\User;
use yii\helpers\Html;

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

    //создать отклик
    public function actionCreateResponse()
    {

        $id_request=Yii::$app->request->post('id_request', null);
        $id_workers=Yii::$app->request->post('id_workers', null);
        $type_workers=Yii::$app->request->post('type_workers', null);
        $date_workers=Yii::$app->request->post('date_workers', null);

        $response = new Response();
        $response -> createResponse($id_request, $id_workers, $type_workers,$date_workers);
        //print($id_request. $id_workers. $type_workers);
        return $this->redirect('/metering/default/my-response');
    }

    //удалить отклик
    public function actionDeleteResponse()
    {

        $id_request=Yii::$app->request->post('id_request', null);
        $id_workers=Yii::$app->request->post('id_workers', null);
        $type_workers=Yii::$app->request->post('type_workers', null);
        $response = new Response();
        $response -> deleteResponse($id_request, $id_workers, $type_workers);
        return $this->redirect('/metering/default/new-request');
    }

    //изменить мои данные
    public function actionUpdateUser()
    {


        $model = new User();
        $model = $model->findOne(Yii::$app->user->getId());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->email=Html::encode(Yii::$app->request->post('User')['email']);
            $model->tel=Html::encode(Yii::$app->request->post('User')['tel']);
            $model->lastname=Html::encode(Yii::$app->request->post('User')['lastname']);
            $model->firstname=Html::encode(Yii::$app->request->post('User')['firstname']);
            $model->secondname=Html::encode(Yii::$app->request->post('User')['secondname']);
            $model->birthday=Html::encode(Yii::$app->request->post('User')['birthday']);
            $model->id_city=Html::encode(Yii::$app->request->post('User')['id_city']);
            $model->address=Html::encode(Yii::$app->request->post('User')['address']);
            $model->save();
            return $this->redirect(['/metering/default/update-user']);

        }

        return $this->render('updateUser', [
            'model' => $model,
        ]);

    }
}
