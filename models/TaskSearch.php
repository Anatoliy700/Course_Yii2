<?php

namespace app\models;

use Yii;
use app\models\tables\Users;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\Tasks;

/**
 * TaskSearch represents the model behind the search form of `app\models\tables\Tasks`.
 */
class TaskSearch extends Tasks
{
  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['id', 'user_id'], 'integer'],
      [['title', 'description', 'date', 'fullUsername'], 'safe'],
    ];
  }
  
  /**
   * {@inheritdoc}
   */
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
    $query = Tasks::find();
    
    // add conditions that should always apply here
    
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'pagination' => [
        'pageSize' => 5
      ]
    ]);
    
    $this->load($params);
    
    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }
    
    $query->with('user');
    
    // grid filtering conditions
    $query->andFilterWhere([
      'id' => $this->id,
      'date' => $this->date,
      'user_id' => $this->user_id,
    ]);
    
    $query->andFilterWhere(['like', 'title', $this->title])
      ->andFilterWhere(['like', 'description', $this->description]);
    
    return $dataProvider;
  }
  
  public function getUser() {
    return $this->hasOne(Users::class, ['id' => 'user_id']);
  }
  
}
