<?php

namespace app\models;

/**
 * This is the model class for table "response".
 *
 * @property int $id
 * @property string $date_create
 * @property int $id_request
 * @property int $id_workers
 * @property string $date_workers
 * @property double $price
 */
class Response extends \yii\db\ActiveRecord
{

    const TYPE_CLIENT = 1; // client - клиент
    const TYPE_METERING = 2; //metering - замерщик
    const TYPE_DELIVERY = 3; //delivery - доставщик
    const TYPE_MOUNTING = 4; //mounting - монтажник
    const TYPE_COMPANY = 5; //company - изготовитель
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'response';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_create', 'date_workers'], 'safe'],
            [['id_request', 'id_workers','type_workers'], 'required'],
            [['id_request', 'id_workers','type_workers'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_create' => 'Дата создания',
            'id_request' => 'Заказ',
            'id_workers' => 'Работник',
            'type_workers' => 'Тип работника',
            'date_workers' => 'Дата работ',
            'price' => 'Стоимость',
        ];
    }

    //есть ли уже отклик у работника
    public function cheсkResponse($id_request, $id_workers, $type_workers)
    {
        $cheсk = $this->find()->where(['id_request'=>$id_request,'id_workers'=>$id_workers,'type_workers'=>$type_workers])->one(); //
        return $cheсk;
    }

    //есть ли уже отклики для заказа
    public function findResponseByRequest($id_request, $type_workers)
    {
        return $this->find()->where(['id_request'=>$id_request,'type_workers'=>$type_workers])->all();
    }

    //список откликнувшихся
    public function findWorkers($id_request, $type_workers)
    {
        $workers = $this->find()->select(['user.id','user.company','user.lastname','user.firstname','user.secondname','response.id_request','response.date_workers','response.price'])->innerJoin('user', 'user.id = response.id_workers')->where(['id_request'=>$id_request,'type_workers'=>$type_workers])->asArray()->all(); //
        return $workers;
    }


    //создание отклика
    public function createResponse($id_request, $id_workers, $type_workers, $date_workers = null, $price = null) //new DateTime()->format('Y-m-d H:i:s')
    {
        //проверка что уже есть

        if(!$this->cheсkResponse($id_request, $id_workers, $type_workers))
        {
            $response = new Response();
            $response->id_request = $id_request;
            $response->id_workers = $id_workers;
            $response->type_workers = $type_workers;
            $response->date_workers = $date_workers;
            $response->price = $price;
            $response->save();
            return true;
        } else {
            return false;
        }

    }

    //удалить отклик
    public function deleteResponse($id_request, $id_workers, $type_workers)
    {
        //проверка что уже есть
        if($this->cheсkResponse($id_request, $id_workers, $type_workers))
        {
            $res=$this->find()->where(['id_request'=>$id_request,'id_workers'=>$id_workers,'type_workers'=>$type_workers])->one();

            $res->delete();
            return true;
        } else {
            return false;
        }

    }
}
