<?php

namespace common\models;

use common\models\query\ArticleCategoryQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use trntv\filekit\behaviors\UploadBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title_hy
 * @property string $title_en
 * @property string $title_ru
 * @property string $keywords_hy
 * @property string $keywords_en
 * @property string $keywords_ru
 * @property string $description_hy
 * @property string $description_en
 * @property string $description_ru
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property integer $status
 *
 * @property Article[] $articles
 * @property ArticleCategory $parent
 */
class ArticleCategory extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    /**
     * @var array
     */
    public $thumbnail;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_category}}';
    }

    /**
     * @return ArticleCategoryQuery
     */
    public static function find()
    {
        return new ArticleCategoryQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title_en',
                'immutable' => true
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_hy'], 'required'],
            [['title_hy', 'title_en', 'title_ru'], 'string', 'max' => 512],
            [['keywords_hy', 'keywords_en', 'keywords_ru'], 'string', 'max' => 256],
            [['description_hy', 'description_en', 'description_ru'], 'string', 'max' => 250],
            [['slug'], 'unique'],
            [['body'], 'string'],
            [['slug','thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['thumbnail'], 'safe'],
            ['status', 'integer'],
            ['parent_id', 'exist', 'targetClass' => ArticleCategory::className(), 'targetAttribute' => 'id']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'slug' => Yii::t('common', 'Slug'),
            'title_hy' => 'Title',
            'title_en' => 'Title',
            'title_ru' => 'Title',
            'keywords_hy' => 'SEO Keywords',
            'keywords_en' => 'SEO Keywords',
            'keywords_ru' => 'SEO Keywords',
            'body' => 'Body',
            'description_hy' => 'Description',
            'description_en' => 'Description',
            'description_ru' => 'Description',
            'thumbnail_base_url' => 'Thumbnail Base Url',
            'thumbnail_path' => 'Thumbnail Path',
            'thumbnail' => Yii::t('common', 'Thumbnail'),
            'parent_id' => Yii::t('common', 'Parent Category'),
            'status' => Yii::t('common', 'Active')
        ];
    }

    public function getMultilingual($multilingualField, $lang){
        return $this->getMultilingualParams($multilingualField."_".$lang);
    }

    private function getMultilingualParams($fieldLang){
        $arr = [
            'title_hy' => $this->title_hy,
            'title_en' => $this->title_en,
            'title_ru' => $this->title_ru,
            'keywords_hy' => $this->keywords_hy,
            'keywords_en' => $this->keywords_en,
            'keywords_ru' => $this->keywords_ru,
            'description_hy' => $this->description_hy,
            'description_en' => $this->description_en,
            'description_ru' => $this->description_ru,
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
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasMany(ArticleCategory::className(), ['id' => 'parent_id']);
    }
}
