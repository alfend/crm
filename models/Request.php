<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $id_client
 * @property string $date_create
 * @property string $address
 * @property string $address_client_street
 * @property string $address_client_house
 * @property string $address_client_room
 * @property string $comment_request
 * @property int $id_metering
 * @property string $date_metering_plan
 * @property string $date_metering
 * @property int $id_delivery
 * @property int $price_delivery
 * @property int $id_mounting
 * @property int $price_mounting
 * @property int $type_price
 * @property int $id_company
 * @property double $price_company
 * @property double $price_request
 * @property double $deposit_transfer
 * @property double $deposit_cash
 * @property int $type_deposit
 * @property int $status_price
 * @property int $status_request
 */
class Request extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = -1;
    const STATUS_CREATE = 0;// BEFORE _AFTER
    const STATUS_METERING_BEFORE = 2;
    const STATUS_METERING_AFTER = 3;
    const STATUS_COMPANY_BEFORE_AFTER = 4;
    const STATUS_COMPANY_AFTER = 5;
    const STATUS_DELEVERY_BEFORE = 6;
    const STATUS_DELEVERY_AFTER_ = 7;
    const STATUS_MOUNTING_BEFORE = 8;
    const STATUS_MOUNTING_AFTER = 9;
    const STATUS_FINISH = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_client', 'date_create', 'address', 'date_metering_plan', 'status_request'], 'required'],
            [['id_client','id_city', 'id_metering', 'id_delivery', 'price_delivery', 'id_mounting', 'price_mounting', 'type_price', 'id_company', 'type_deposit', 'status_price', 'status_request'], 'integer'],
            [['date_create', 'date_metering_plan', 'date_metering'], 'safe'], //,'date' , 'format'=>'Y-m-d'
            [['comment_request'], 'string'],
            [['price_company', 'price_request', 'deposit_transfer', 'deposit_cash'], 'number'],
            [['address'], 'string', 'max' => 255],
            [['address_client_street', 'address_client_house', 'address_client_room'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_client' => 'Клиент',
            'date_create' => 'Дата создания',
            'id_city' => 'Город',
            'address' => 'Адрес',
            'address_client_street' => 'Улица',
            'address_client_house' => 'Дом',
            'address_client_room' => 'Квартира',
            'comment_request' => 'Комментарий',
            'id_metering' => 'Замерщик',
            'date_metering_plan' => 'Дата замера',
            'time_from_metering_plan' => 'Время замера от',
            'time_to_metering_plan' => 'Время замера до',
            'date_metering' => 'Дата замера',
            'id_delivery' => 'Доставщик',
            'price_delivery' => 'Стоимость доставки',
            'id_mounting' => 'Монтажник',
            'price_mounting' => 'Стоимость монтажа',
            'type_price' => 'Тип цены',
            'id_company' => 'Изготовитель',
            'price_company' => 'Стоимость изготовления',
            'price_request' => 'Стоимость заказа',
            'deposit_transfer' => 'Deposit Transfer',
            'deposit_cash' => 'Deposit Cash',
            'type_deposit' => 'Тип оплаты',
            'status_price' => 'Статус оплаты',
            'status_request' => 'Статус заказа',
        ];
    }

    //все заказы на клиента
    public function getRequestByClientAndStatus($id_client, $status)
    {
        return static::find()->where(['id_client' => $id_client, 'status_request' => $status])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }

    //все заказы на отклик
    public function getRequestByStatus($id_city,$status)
    {
        return static::find()->where(['id_city' => $id_city, 'status_request' => $status])->asArray()->all(); //, 'status' => self::STATUS_ACTIVE]
    }

}
