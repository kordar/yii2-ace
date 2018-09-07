<?php

namespace kordar\ace\models\admin;

use kordar\ace\web\traits\SearchTrait;
use yii\data\ActiveDataProvider;

/**
 * AdminSearch represents the model behind the search form about `kordar\ace\models\Admin`.
 */
class AdminSearch extends Admin
{

    use SearchTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'type'], 'integer'],
            [['dropDownSearch', 'dropDownSearchInput', 'dropDownSearchExt', 'dropDownSearchBetweenData', 'dropDownSearchBetweenDataStart', 'dropDownSearchBetweenDataEnd'], 'safe'],
        ];
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
        $query = Admin::find()->select('*')->addSelect(Admin::extFieldsByCase());

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

        if (!empty($this->dropDownSearchBetweenDataStart) && !empty($this->dropDownSearchBetweenDataEnd)) {
            $query->andFilterWhere(['between', $this->dropDownSearchBetweenData, strtotime($this->dropDownSearchBetweenDataStart), strtotime($this->dropDownSearchBetweenDataEnd)]);
        }

        if (!empty($this->dropDownSearch)) {

            if ($this->dropDownSearchExt == 'EQ') {
                $query->andFilterWhere([$this->dropDownSearch => $this->dropDownSearchInput]);
            }

            if ($this->dropDownSearchExt == 'LIKE') {
                $query->andFilterWhere(['like', $this->dropDownSearch, $this->dropDownSearchInput]);
            }

        }

        // grid filtering conditions
        $query->andFilterWhere(['status' => $this->status, 'type' => $this->type]);

        return $dataProvider;
    }
}
