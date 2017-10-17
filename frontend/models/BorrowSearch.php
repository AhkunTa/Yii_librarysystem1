<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Borrow;

/**
 * BorrowSearch represents the model behind the search form about `common\models\Borrow`.
 */
class BorrowSearch extends Borrow
{
    /**
     * @inheritdoc
     */
    public  function attributes()
    {
        return array_merge(parent::attributes(),['book.bookname']);
    }

    public function rules()
    {
        return [
            [['borrowid', 'userid', 'ifback'], 'integer'],
            [['bookid', 'borrowtime', 'backtime','book.bookname'], 'safe'],
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
        $userid=Yii::$app->session->get('userid');
        $query = Borrow::find()->where(['userid'=>$userid]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'borrowid' => $this->borrowid,
            'userid' => $this->userid,
            'borrowtime' => $this->borrowtime,
            'backtime' => $this->backtime,
            'ifback' => $this->ifback,
        ]);

        $query->andFilterWhere(['like', 'bookid', $this->bookid]);


        $query->join('INNER JOIN','library_book','library_book.bookid = library_borrow.bookid');

        $query->andFilterWhere(['like','library_book.bookname',$this->getAttribute('book.bookname')]);
        $dataProvider->sort->attributes['book.bookname']=
            [
                'asc'=>['library_book.bookname'=>SORT_ASC],
                'desc'=>['library_book.bookname'=>SORT_DESC],
            ];
        $dataProvider->sort->defaultOrder =
            [
                'ifback'=>SORT_DESC,
                'backtime'=>SORT_ASC,
            ];


        return $dataProvider;
    }
}
