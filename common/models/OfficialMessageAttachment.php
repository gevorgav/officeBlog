<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "official_message_attachment".
 *
 * @property integer $id
 * @property integer $official_message_id
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property integer $size
 * @property string $name
 * @property integer $created_at
 * @property integer $order
 */
class OfficialMessageAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%official_message_attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'official_message_id', 'path'], 'required'],
            [['id', 'official_message_id', 'size', 'created_at', 'order'], 'integer'],
            [['path', 'base_url', 'type', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'official_message_id' => 'Official Message ID',
            'path' => 'Path',
            'base_url' => 'Base Url',
            'type' => 'Type',
            'size' => 'Size',
            'name' => 'Name',
            'created_at' => 'Created At',
            'order' => 'Order',
        ];
    }

    public function getOfficialMessage()
    {
        return $this->hasOne(OfficialMessage::className(), ['id' => 'official_message_id']);
    }

    public function getUrl()
    {
        return $this->base_url . '/' . $this->path;
    }
}
