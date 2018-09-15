<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 05.11.2017
 * Time: 14:22
 */

namespace common\models\query;


use common\models\OfficialMessageCategory;
use yii\db\ActiveQuery;

class OfficialMessageCategoryQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['status' => OfficialMessageCategory::STATUS_ACTIVE]);

        return $this;
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%official_message_category}}.parent_id IS NULL');

        return $this;
    }
}