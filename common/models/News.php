<?php

namespace common\models;

use common\models\query\NewsQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
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
 * @property string $location_name_hy
 * @property string $location_name_en
 * @property string $location_name_ru
 * @property string $address_hy
 * @property string $address_en
 * @property string $address_ru
 * @property boolean $isGallery
 * @property string $video_link
 * @property string $agenda_hy
 * @property string $agenda_en
 * @property string $agenda_ru
 * @property string $keywords_hy
 * @property string $keywords_en
 * @property string $keywords_ru
 * @property string $tags
 * @property integer $category_id
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $published_at
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $author
 * @property User $updater
 * @property NewsCategory $category
 * @property NewsAttachment[] $newsAttachments
 */
class News extends \yii\db\ActiveRecord
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
        return '{{%news}}';
    }

    public static function find()
    {
        return new NewsQuery(get_called_class());
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
                'uploadRelation' => 'newsAttachments',
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
            [['title_hy','body_hy', 'short_description_hy','category_id'], 'required'],
            [['slug'], 'unique'],
            [['body_hy', 'body_en', 'body_ru', 'tags'], 'string'],
            [['title_hy', 'title_en', 'title_ru'], 'string', 'max' => 512],
            [['short_description_hy', 'short_description_en', 'short_description_ru',], 'string', 'max' => 250],
            [['keywords_hy', 'keywords_en', 'keywords_ru'], 'string', 'max' => 256],
            [['isGallery'], 'boolean'],
            [['published_at'], 'default', 'value' => function () {
                return date(DATE_ISO8601);
            }],
            [['published_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['category_id'], 'exist', 'targetClass' => NewsCategory::className(), 'targetAttribute' => 'id'],
            [['status'], 'integer'],
            [['slug', 'video_link', 'thumbnail_base_url', 'preview_base_url','thumbnail_path','preview_path'], 'string', 'max' => 1024],
            [['view'], 'string', 'max' => 255],
            [['attachments', 'thumbnail', 'preview'], 'safe']
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
            'keywords_ru' => $this->keywords_ru
        ];
        foreach ($arr as $i => $value) {
            if ($fieldLang == $i)
                return($arr[$i]);
        }
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
            'body_hy' => 'Body',
            'body_en' => 'Body',
            'body_ru' => 'Body',
            'short_description_hy' => 'Short Description',
            'short_description_en' => 'Short Description',
            'short_description_ru' => 'Short Description',
            'keywords_hy' => 'SEO Keywords',
            'keywords_en' => 'SEO Keywords',
            'keywords_ru' => 'SEO Keywords',
            'view' => 'View',
            'isGallery' => 'Is Gallery',
            'video_link' => 'YouTube Video ID',
            'tags' => 'Tags',
            'category_id' => 'Category ID',
            'thumbnail_base_url' => 'Header Base Url',
            'thumbnail_path' => 'Header Path',
            'thumbnail' => 'Header photo',
            'preview_base_url' => 'Preview Base Url',
            'preview_path' => 'Preview Path',
            'preview' => 'Preview photo',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'published_at' => 'Published At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
        return $this->hasOne(NewsCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsAttachments()
    {
        return $this->hasMany(NewsAttachment::className(), ['news_id' => 'id']);
    }
}
