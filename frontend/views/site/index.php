<?php
/* @var $this yii\web\View
 * @var $slider common\models\Slider
 * @var $upcoming common\models\News
 * @var $configs common\models\HomePageConfigs
 */
$this->title = Yii::$app->name;

use frontend\models\search\GeneralSearch;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php
//search
$searchModel = new GeneralSearch();
if (Yii::$app->getRequest()->getQueryParam('search') != null) {
    $searchModel->search = Yii::$app->getRequest()->getQueryParam('search');
}
?>

<div id="content" class="content">
    <div class="news-wrap">
        <h2>News</h2>
        <?php foreach ($newsList as $news): ?>
            <div id="article_1" class="article">
                <div class="thumbnail">
                    <?= Html::a('<img src="' . $news->preview_base_url . '/' . $news->preview_path . '"/>', ['news/view', 'slug' => $news->slug],
                        ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
                </div>
                <time><?php echo Yii::$app->formatter->asDate($news->published_at, "d MMM, y HH:MM") ?></time>
                <?= Html::a('<h3>' . $news->getMultilingual('title', YII::$app->language) . '</h3>', ['news/view', 'slug' => $news->slug],
                    ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
                <?= Html::a('<p>' . $news->getMultilingual("short_description", YII::$app->language) . '</p>', ['news/view', 'slug' => $news->slug],
                    ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
            </div>
        <?php endforeach; ?>
        <div class="all-news clearfix"><?= Html::a(Yii::t('frontend', 'All News'), ['news/index'],
                ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?></div>
    </div>
    <div class="official-message-warp">
        <h2>Official message</h2>

        <?php foreach ($officialMessages as $officialMessage): ?>
            <div id="official_message" class="official-message">
                <time><?php echo Yii::$app->formatter->asDate($officialMessage->published_at, "d MMM, y HH:MM") ?></time>
                <?= Html::a('<h3>' . $officialMessage->getMultilingual('title', YII::$app->language) . '</h3>', ['official-messages/view', 'slug' => $officialMessage->slug],
                    ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
                <?= Html::a('<p>' . $officialMessage->getMultilingual("short_description", YII::$app->language) . '</p>', ['official-messages/view', 'slug' => $officialMessage->slug],
                    ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
            </div>
        <?php endforeach; ?>
        <div class="see-all clearfix"><?= Html::a(Yii::t('frontend', 'See All'), ['official-messages/index'],
                ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?></div>
    </div>
</div>

<div id="right_sidebar" class="right-sidebar">
    <div class="widget widget-search">
        <h2> Search </h2>
        <?php if ($searchModel->search == null) { ?>
            <?php $form = ActiveForm::begin(); ?>
            <div class="search hidden-sm hidden-xs">
                <?= $form->field($searchModel, 'search')->textInput(['class' => 'search-input', 'placeholder' => Yii::t('frontend', 'Search')])->label('')->label(false) ?>
            </div>
            <?php ActiveForm::end(); ?>
        <?php } ?>
    </div>
    <div class="widget widget-connect-us">
        <h2> Connect with us </h2>
        <a class="connect" href="<?= Yii::$app->homeUrl ?>/contact">
            <i class="icon-mail"></i>
            Contact US
        </a>
    </div>
</div>
<div class="clearfix"></div>
