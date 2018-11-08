<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['list_name', 'cat_ids', 'hrurl', 'title', 'description', 'keywords', 'exerpt', 'exerpt_big', 'h1', 'topimage', 'topimage_alt', 'background_image', 'thumbnail_image', 'call2action_description', 'call2action_name', 'call2action_link', 'call2action_class', 'call2action_comment', 'imagelink', 'imagelink_alt', 'author', 'status', 'view', 'layout', 'site'], 'safe'],
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
        $query = Article::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'list_name', $this->list_name])
            ->andFilterWhere(['like', 'cat_ids', $this->cat_ids])
            ->andFilterWhere(['like', 'hrurl', $this->hrurl])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'exerpt', $this->exerpt])
            ->andFilterWhere(['like', 'exerpt_big', $this->exerpt_big])
            ->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'topimage', $this->topimage])
            ->andFilterWhere(['like', 'topimage_alt', $this->topimage_alt])
            ->andFilterWhere(['like', 'background_image', $this->background_image])
            ->andFilterWhere(['like', 'thumbnail_image', $this->thumbnail_image])
            ->andFilterWhere(['like', 'call2action_description', $this->call2action_description])
            ->andFilterWhere(['like', 'call2action_name', $this->call2action_name])
            ->andFilterWhere(['like', 'call2action_link', $this->call2action_link])
            ->andFilterWhere(['like', 'call2action_class', $this->call2action_class])
            ->andFilterWhere(['like', 'call2action_comment', $this->call2action_comment])
            ->andFilterWhere(['like', 'imagelink', $this->imagelink])
            ->andFilterWhere(['like', 'imagelink_alt', $this->imagelink_alt])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'view', $this->view])
            ->andFilterWhere(['like', 'layout', $this->layout])
            ->andFilterWhere(['like', 'site', $this->site]);

        return $dataProvider;
    }
}
