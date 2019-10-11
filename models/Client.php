<?php

namespace app\models;

//use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $type
 * @property string $date_create
 * @property int $id_city
 * @property string $lastname
 * @property string $firstname
 * @property string $secondname
 * @property string $organization
 * @property string $birthday
 * @property string $address
 * @property string $email
 * @property string $tel
 * @property string $password
 * @property int $sys_notice
 * @property int $news_notice
 * @property int $id_requisite
 * @property int $status 0-зарегистрирован, 1 подтвержден
 * @property int $category 0-фл, 1 - юл, 2 - смешанный тип
 * @property string $foto
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_create', 'id_city', 'lastname', 'firstname', 'email', 'tel', 'password'], 'required'],
            [['date_create', 'birthday'], 'safe'],
            [['id_city', 'sys_notice', 'news_notice', 'id_requisite', 'status', 'category'], 'integer'],
            [['type', 'lastname', 'firstname', 'secondname', 'tel'], 'string', 'max' => 50],
            [['organization', 'address', 'email', 'password', 'foto'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'date_create' => 'Date Create',
            'id_city' => 'Id City',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'secondname' => 'Secondname',
            'organization' => 'Organization',
            'birthday' => 'Birthday',
            'address' => 'Address',
            'email' => 'Email',
            'tel' => 'Tel',
            'password' => 'Password',
            'sys_notice' => 'Sys Notice',
            'news_notice' => 'News Notice',
            'id_requisite' => 'Id Requisite',
            'status' => 'Status',
            'category' => 'Category',
            'foto' => 'Foto',
        ];
    }
}
