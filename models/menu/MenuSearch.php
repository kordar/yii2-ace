<?php

namespace kordar\ace\models\menu;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use kordar\ace\models\menu\MenuView;

/**
 * MenuSearch represents the model behind the search form about `kordar\ace\models\menu\MenuView`.
 */
class MenuSearch extends MenuView
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'active', 'sort', 'status', 'hidden', 'created_at', 'updated_at'], 'integer'],
            [['title', 'href', 'language', 'icon', 'parent_title', 'hidden_name'], 'safe'],
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
        $extenHidden = "(CASE `hidden` WHEN 0 THEN '" . Yii::t('ace', 'No') . "' WHEN 1 THEN '" . Yii::t('ace', 'Yes') . "' END)";
        $query = MenuView::find()->select('*')->addSelect([$extenHidden . ' AS hidden_name']);

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
            'parent_id' => $this->parent_id,
            'active' => $this->active,
            'sort' => $this->sort,
            'status' => $this->status,
            'hidden' => $this->hidden,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'href', $this->href])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'parent_title', $this->parent_title]);

        return $dataProvider;
    }
}
