<?php
/**
 * Created by PhpStorm.
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\News;
use yii\db\ActiveQuery;

class NewsQuery extends ActiveQuery
{
    public function published()
    {
        $this->andWhere(['status' => News::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%news}}.published_at', time()]);
        return $this;
    }
}
