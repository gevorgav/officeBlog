<?php
use common\models\NewsCategory;
use frontend\models\search\GeneralSearch;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $nextModel common\models\News */
/* @var $activities Array common\models\Activity */

//------ SEO ------------
$this->title = $model->getMultilingual('title', YII::$app->language);

$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->getMultilingual('short_description', YII::$app->language),
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model->getMultilingual('keywords', YII::$app->language),
]);

//search
$searchModel = new GeneralSearch();
if (Yii::$app->getRequest()->getQueryParam('search') != null) {
    $searchModel->search = Yii::$app->getRequest()->getQueryParam('search');
}
?>

<div id="content" class="content">
    <div class="news-wrap">
        <?= Html::a('<h2>'.Yii::t('frontend', 'Official Messages').'</h2>', ['official-messages/index'],
            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
        <div id="article_1" class="article">
            <time><?php echo Yii::$app->formatter->asDate($model->published_at, "d MMM, y HH:MM") ?></time>
            <h3><?= $model->getMultilingual('title', YII::$app->language)?></h3>
            <samp><?= nl2br($model->getMultilingual("body", YII::$app->language) )?></samp>
        </div>
    </div>
</div>
<div id="right_sidebar" class="right-sidebar">
    <div class="widget widget-search">
        <h2> <?= Yii::t('frontend', 'Search')?> </h2>
        <?php if ($searchModel->search == null) { ?>
            <?php $form = ActiveForm::begin(); ?>
            <div class="search hidden-sm hidden-xs">
                <?= $form->field($searchModel, 'search')->textInput(['class' => 'search-input', 'placeholder' => Yii::t('frontend', 'Search')])->label('')->label(false) ?>
            </div>
            <?php ActiveForm::end(); ?>
        <?php } ?>
    </div>
    <div class="widget widget-connect-us">
        <h2 style="font-size: 14px;"><?= Yii::t('frontend', 'Latest Messages')?>  </h2>
        <?php foreach ($latestNews as $news): ?>
            <time><?php echo Yii::$app->formatter->asDate($news->published_at, "d MMM, y HH:MM") ?></time>
            <?= Html::a('<h5>' . $news->getMultilingual('title', YII::$app->language) . '</h5>', ['official-messages/view', 'slug' => $news->slug],
            ['class' => 'calendar-visit-event']) ?>
            <br>
        <?php endforeach;?>
    </div>
    <div class="widget widget-connect-us">
        <h2><?= Yii::t('frontend', 'Connect  with us')?> </h2>
        <a class="connect" href="<?= Yii::$app->homeUrl?>/contact">
            <i class="icon-mail"></i>
            Contact US
        </a>
    </div>
</div>
<div class="clearfix"></div>