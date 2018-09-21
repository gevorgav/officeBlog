<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\News
 */
use yii\helpers\Html;

?>



<div id="article_1" class="article">
    <time><?= Yii::$app->formatter->asDate($model->published_at, "d MMM, y HH:MM") ?></time>
    <?= Html::a('<h3>' . $model->getMultilingual('title', YII::$app->language) . '</h3>', ['view', 'slug' => $model->slug],
        ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
    <?= Html::a('<p>' . $model->getMultilingual("short_description", YII::$app->language) . '</p>', ['view', 'slug' => $model->slug],
        ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
</div>
