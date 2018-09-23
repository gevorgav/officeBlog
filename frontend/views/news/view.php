<?php
use common\models\EventCategory;
use frontend\models\search\GeneralSearch;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $nextModel common\models\News */
/* @var $item common\models\News */
/* @var $upcoming [] */
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

$this->registerJsFile(
    '/gallery-js/ug-common-libraries.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-functions.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-thumbsgeneral.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-thumbsstrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-touchthumbs.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-panelsbase.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-strippanel.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-gridpanel.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-thumbsgrid.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-tiles.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-tiledesign.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-avia.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-slider.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-sliderassets.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-touchslider.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-zoomslider.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-video.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-gallery.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);


$this->registerJsFile(
    '/gallery-js/ug-lightbox.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-carousel.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-api.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-themes/default/ug-theme-default.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile("/gallery-css/unite-gallery.css");
$this->registerCssFile("/gallery-themes/default/ug-theme-default.css");

$this->registerJs(
    "
        jQuery(document).ready(function(){

                    jQuery(\"#gallery\").unitegallery();

                });
    ");
//$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Events'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

//search
$searchModel = new GeneralSearch();
if (Yii::$app->getRequest()->getQueryParam('search') != null) {
    $searchModel->search = Yii::$app->getRequest()->getQueryParam('search');
}
?>

<div id="content" class="content">
    <div class="news-wrap">
        <?= Html::a('<h2>'.Yii::t('frontend', 'News').'</h2>', ['news/index'],
            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
        <div id="article_1" class="article">
            <div class="thumbnail">
                <img src="<?= $model->preview_base_url . '/' . $model->preview_path?>"/>
            </div>
            <time><?php echo Yii::$app->formatter->asDate($model->published_at, "d MMM, y HH:MM") ?></time>
            <h3><?= $model->getMultilingual('title', YII::$app->language)?></h3>
            <p><?= nl2br($model->getMultilingual("body", YII::$app->language) )?></p>
        </div>
        <br>
        <br>
        <?php if ( count($model->newsAttachments) != 0 || !empty($model->video_link)):?>
            <div class="item">
                <div id="gallery" style="display:none;">
                    <?php if (!empty($model->video_link)):?>
                        <img alt="<?= $model->getMultilingual('title', Yii::$app->language)?>"
                             data-type="youtube"
                             data-videoid="<?= $model->video_link?>">
                    <?php endif;?>
                    <?php if (count($model->newsAttachments) != 0):?>
                        <?php foreach ($model->newsAttachments as $attach):?>
                            <img alt="Preview Image 1"
                                 src="<?= $attach->base_url."/".$attach->path?>"
                                 data-image="<?= $attach->base_url."/".$attach->path?>"
                            >
                        <?php endforeach;?>
                    <?php endif;?>
                </div>

            </div>
        <?php endif; ?>
    </div>
</div>
<div id="right_sidebar" class="right-sidebar">
    <div class="widget widget-search">
        <h2> <?= Yii::t('frontend', 'Search')?> </h2>
        <?php if ($searchModel->search == null) { ?>
            <?php $form = ActiveForm::begin(); ?>
            <div class="search hidden-sm hidden-xs">
                <?= $form->field($searchModel, 'search')->textInput(['class' => 'search-input'])->label('')->label(false) ?>
            </div>
            <?php ActiveForm::end(); ?>
        <?php } ?>
    </div>
    <div class="widget widget-connect-us">
        <h2><?= Html::a(Yii::t('frontend', 'Latest News'), ['news/index'],
                ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?></h2>
        <?php foreach ($upcoming as $news): ?>
            <time><?php echo Yii::$app->formatter->asDate($news->published_at, "d MMM, y HH:MM") ?></time>
            <?= Html::a('<h5>' . $news->getMultilingual('title', YII::$app->language) . '</h5>', ['news/view', 'slug' => $news->slug],
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



