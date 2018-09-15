<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 05.11.2017
 * Time: 14:25
 */

namespace backend\models\search;

use common\models\OfficialMessage;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class OfficialMessageSearch extends OfficialMessage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'created_by', 'updated_by', 'status', 'published_at', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'title_hy', 'body_hy'], 'safe'],
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
        $query = OfficialMessage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'slug' => $this->slug,
            'created_by' => $this->created_by,
            'category_id' => $this->category_id,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title_hy', $this->title_hy])
            ->andFilterWhere(['like', 'body_hy', $this->body_hy]);

        return $dataProvider;
    }
}