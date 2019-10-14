<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Worker;

/**
 * WorkerSearch represents the model behind the search form of `app\models\Worker`.
 */
class WorkerSearch extends Worker
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_city', 'sys_notice', 'news_notice', 'id_requisite', 'status', 'category', 'commission'], 'integer'],
            [['type', 'date_create', 'lastname', 'firstname', 'secondname', 'organization', 'birthday', 'address', 'email', 'tel', 'password', 'foto'], 'safe'],
            [['coefficient'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Worker::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_create' => $this->date_create,
            'id_city' => $this->id_city,
            'birthday' => $this->birthday,
            'sys_notice' => $this->sys_notice,
            'news_notice' => $this->news_notice,
            'id_requisite' => $this->id_requisite,
            'status' => $this->status,
            'category' => $this->category,
            'commission' => $this->commission,
            'coefficient' => $this->coefficient,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'secondname', $this->secondname])
            ->andFilterWhere(['like', 'organization', $this->organization])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
