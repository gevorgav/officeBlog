<?php

use common\grid\EnumColumn;
use common\models\OfficialMessageCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\OfficialMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Official Message');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">


    <p>
        <?= Html::a(
            Yii::t('backend', 'Create Official Message', ['modelClass' => 'OfficialMessage']),
            ['create'],
            ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [

            'id',
            'slug',
            'title_hy',
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category ? $model->category->title_hy : null;
                },
                'filter' => ArrayHelper::map(OfficialMessageCategory::find()->all(), 'id', 'title_hy')
            ],
            [
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return $model->author->username;
                }
            ],
            [
                'class' => EnumColumn::className(),
                'attribute' => 'status',
                'enum' => [
                    Yii::t('backend', 'Not Published'),
                    Yii::t('backend', 'Published')
                ]
            ],
            'published_at:datetime',
            'created_at:datetime',

            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ]
        ]
    ]); ?>
</div>
