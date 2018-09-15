<?php

namespace common\models;

use common\models\query\OfficialMessageCategoryQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "official_message_category".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title_hy
 * @property string $title_en
 * @property string $title_ru
 * @property string $body
 * @property integer $parent_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class OfficialMessageCategory extends ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%official_message_category}}';
    }

    /**
     * @return OfficialMessageCategoryQuery
     */
    public static function find()
    {
        return new OfficialMessageCategoryQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title_en',
                'immutable' => true
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_en'], 'required'],
            [['id', 'parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['body'], 'string'],
            [['slug'], 'unique'],
            [['slug'], 'string', 'max' => 1024],
            [['title_hy', 'title_en', 'title_ru'], 'string', 'max' => 512],
            ['parent_id', 'exist', 'targetClass' => OfficialMessageCategory::className(), 'targetAttribute' => 'id']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'title_hy' => 'Title',
            'title_en' => 'Title',
            'title_ru' => 'Title',
            'body' => 'Body',
            'parent_id' => 'Parent ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getMultilingual($multilingualField, $lang){
        return $this->getMultilingualParams($multilingualField."_".$lang);
    }

    private function getMultilingualParams($fieldLang){
        $arr = [
            'title_hy' => $this->title_hy,
            'title_en' => $this->title_en,
            'title_ru' => $this->title_ru
        ];
        foreach ($arr as $i => $value) {
            if ($fieldLang == $i)
                return($arr[$i]);
        }

        return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfficialMessage()
    {
        return $this->hasMany(OfficialMessage::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasMany(OfficialMessageCategory::className(), ['id' => 'parent_id']);
    }


}
