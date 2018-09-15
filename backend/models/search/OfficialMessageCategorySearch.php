<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 05.11.2017
 * Time: 14:27
 */

namespace backend\models\search;


use common\models\OfficialMessageCategory;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class OfficialMessageCategorySearch extends OfficialMessageCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['slug', 'title_hy'], 'safe'],
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
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = OfficialMessageCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title_hy', $this->title_hy]);

        return $dataProvider;
    }
}