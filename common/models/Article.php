<?php

namespace common\models;

use common\models\query\ArticleQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title_hy
 * @property string $title_en
 * @property string $title_ru
 * @property string $body_hy
 * @property string $body_en
 * @property string $body_ru
 * @property string $view
 * @property string $short_description_hy
 * @property string $short_description_en
 * @property string $short_description_ru
 * @property string $keywords_hy
 * @property string $keywords_en
 * @property string $keywords_ru
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property array $attachments
 * @property integer $category_id
 * @property integer $status
 * @property integer $published_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $author
 * @property User $updater
 * @property ArticleCategory $category
 * @property ArticleAttachment[] $articleAttachments
 */
class Article extends ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 0;

    /**
     * @var array
     */
    public $attachments;

    /**
     * @var array
     */
    public $thumbnail;

    /**
     * @var array
     */
    public $preview;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @return ArticleQuery
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title_hy',
                'immutable' => true
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'articleAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'orderAttribute' => 'order',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'preview',
                'pathAttribute' => 'preview_path',
                'baseUrlAttribute' => 'preview_base_url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_hy', 'short_description_hy', 'category_id'], 'required'],
            [['slug'], 'unique'],
            [['body_hy', 'body_en', 'body_ru'], 'string'],
            [['title_hy', 'title_en', 'title_ru'], 'string', 'max' => 512],
            [['short_description_hy', 'short_description_en', 'short_description_ru'], 'string', 'max' => 250],
            [['keywords_hy', 'keywords_en', 'keywords_ru'], 'string', 'max' => 256],
            [['published_at'], 'default', 'value' => function () {
                return date(DATE_ISO8601);
            }],
            [['published_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['category_id'], 'exist', 'targetClass' => ArticleCategory::className(), 'targetAttribute' => 'id'],
            [['status'], 'integer'],
            [['slug', 'thumbnail_base_url', 'thumbnail_path', 'preview_base_url', 'preview_path'], 'string', 'max' => 1024],
            [['view'], 'string', 'max' => 255],
            [['attachments', 'thumbnail','preview'], 'safe']
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
            'body_hy' => 'Body',
            'body_en' => 'Body',
            'body_ru' => 'Body',
            'short_description_hy' => 'Short Description',
            'short_description_en' => 'Short Description',
            'short_description_ru' => 'Short Description',
            'keywords_hy' => 'SEO Keywords',
            'keywords_en' => 'SEO Keywords',
            'keywords_ru' => 'SEO Keywords',
            'view' => Yii::t('common', 'Article View'),
            'thumbnail' => Yii::t('common', 'Header photo'),
            'preview' => Yii::t('common', 'Preview photo'),
            'category_id' => Yii::t('common', 'Category'),
            'status' => Yii::t('common', 'Published'),
            'published_at' => Yii::t('common', 'Published At'),
            'created_by' => Yii::t('common', 'Author'),
            'updated_by' => Yii::t('common', 'Updater'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At')
        ];
    }

    public function getMultilingual($multilingualField, $lang){
        return $this->getMultilignualParams($multilingualField."_".$lang);
    }

    private function getMultilignualParams($fieldLang){
        $arr = [
            'title_hy' => $this->title_hy,
            'title_en' => $this->title_en,
            'title_ru' => $this->title_ru,
            'body_hy' => $this->body_hy,
            'body_en' => $this->body_en,
            'body_ru' => $this->body_ru,
            'short_description_hy' => $this->short_description_hy,
            'short_description_en' => $this->short_description_en,
            'short_description_ru' => $this->short_description_ru,
            'keywords_hy' => $this->keywords_hy,
            'keywords_en' => $this->keywords_en,
            'keywords_ru' => $this->keywords_ru,
        ];
        foreach ($arr as $i => $value) {
            if ($fieldLang == $i)
                return($arr[$i]);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleAttachments()
    {
        return $this->hasMany(ArticleAttachment::className(), ['article_id' => 'id']);
    }

}
