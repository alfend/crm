<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_metering".
 *
 * @property int $id
 * @property int $id_request
 * @property int $id_workers
 * @property int $count_ceiling
 * @property double $area
 * @property int $perimeter
 * @property int $spot
 * @property int $luster
 * @property int $curtain
 * @property int $cut_pipe
 * @property string $file
 */
class DataMetering extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_metering';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_request','count_ceiling', 'perimeter','area','spot', 'luster', 'curtain', 'cut_pipe'], 'required','message'=>'Обязательно'],
            [['id_request', 'id_workers','area', 'count_ceiling', 'perimeter', 'spot', 'luster', 'curtain', 'cut_pipe'], 'integer'],
            [['file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_request' => 'Заказ',
            'id_workers' => 'Работник',
            'count_ceiling' => 'Кол-во потолков',
            'area' => 'Общая площадь(м2)',
            'perimeter' => 'Периметр(м)',
            'spot' => 'Светильников',
            'luster' => 'Люстр',
            'curtain' => 'Гардин',
            'cut_pipe' => 'Обвод труб',
            'file' => 'Файлы',
        ];
    }

    public function cheсkDataMetering($id_request, $id_workers)
    {
        $cheсk = $this->find()->where(['id_request'=>$id_request,'id_workers'=>$id_workers])->one(); //
        return $cheсk;
    }




}
