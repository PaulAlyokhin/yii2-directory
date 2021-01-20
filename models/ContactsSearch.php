<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contacts;

/**
 * ContactsSearch represents the model behind the search form of `app\models\Contacts`.
 */
class ContactsSearch extends Contacts {

    public $search;

    public function rules() {
        return [
            [['id'], 'integer'],
            [['first_name', 'last_name', 'email', 'birthday', 'search'], 'safe'],
        ];
    }

    public function scenarios() {
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
    public function search($params) {
        $query = Contacts::find()->joinWith('contactNumbers');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 12],
        ]);

        $this->load($params);

        if(!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->orFilterWhere(['like', 'LOWER(first_name)', mb_strtolower($this->search)])
            ->orFilterWhere(['like', 'LOWER(last_name)', mb_strtolower($this->search)])
            ->orFilterWhere(['like', ContactNumbers::tableName() . '.number', mb_strtolower($this->search)]);

        return $dataProvider;
    }
}