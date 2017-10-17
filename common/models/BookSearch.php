<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Book;

/**
 * BookSearch represents the model behind the search form about `common\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bookstatus', 'booktypeid', 'bookoperid', 'bookcount', 'bookreserves'], 'integer'],
            [['bookid', 'bookname', 'author', 'booktag', 'bookintroduction'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Book::find();




        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
//            'sort'=>[
//                'defaultOrder'=>[
//                    'id'=>SORT_DESC,]
//                ,]
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
            'bookstatus' => $this->bookstatus,
            'booktypeid' => $this->booktypeid,
            'bookoperid' => $this->bookoperid,
            'bookcount' => $this->bookcount,
            'bookreserves' => $this->bookreserves,
        ]);

        $query->andFilterWhere(['like', 'bookid', $this->bookid])
            ->andFilterWhere(['like', 'bookname', $this->bookname])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'booktag', $this->booktag])
            ->andFilterWhere(['like', 'bookintroduction', $this->bookintroduction]);
        $dataProvider->sort->defaultOrder =
            [
                'bookstatus'=>SORT_DESC,
                'id'=>SORT_DESC,
            ];

        return $dataProvider;
    }
}
