<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = -1;
    const STATUS_REGISTERED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_ALLOWED = 2;

    const TYPE_CLIENT = 1; // client - клиент
    const TYPE_METERING = 2; //metering - замерщик
    const TYPE_DELEVERY = 3; //delivery - доставщик
    const TYPE_MOUNTING = 4; //mounting - монтажник
    const TYPE_COMPANY = 5; //company - изготовитель


    public static function tableName()
    {
        return '{{%user}}';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_REGISTERED]],
        ]
        ;
    }


    /**
     * @inheritdoc
     */
/*    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }
*/



    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */


    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    //поиск по email
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]); //, 'status' => self::STATUS_ACTIVE]
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    //вывод id города в пользователе
    public function getCity($id)
    {
        return static::findOne(['id' => $id]); //, 'status' => self::STATUS_ACTIVE]
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }



    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password); // $password;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
/*    public function validatePassword($password)
    {
        return $this->password === $password;
    }
*/

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
