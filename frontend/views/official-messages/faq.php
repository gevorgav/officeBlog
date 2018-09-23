<?php
/* @var $this yii\web\View
 * @var $upcoming common\models\OfficialMessage
 */
$this->title = Yii::$app->name;

use frontend\models\search\GeneralSearch;
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
        <h2><?= Yii::t('frontend', 'FAQ-title')?> </h2><br>
        <div class="thumbnail">
            <img src="../img/SY_FAQ.png"/>
        </div>
        <?php foreach ($modelList as $model): ?>
            <div id="article_1" class="article">
                <?= '<h4 style="font-weight: bold; margin: 10px;">'.$model->getMultilingual('title', YII::$app->language).'</h4>'?>
                <?= $model->getMultilingual("body", YII::$app->language) ?>
                <br>
            </div>
        <?php endforeach; ?>
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
        <h2><?= Html::a(Yii::t('frontend', 'Latest Messages'), ['official-messages/index'],
                ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none;']) ?></h2>
        <br>
        <?php foreach ($officialMessages as $officialMessage): ?>
            <time><?php echo Yii::$app->formatter->asDate($officialMessage->published_at, "d MMM, y HH:MM") ?></time>
            <?= Html::a('<h5>' . $officialMessage->getMultilingual('title', YII::$app->language) . '</h5>', ['official-messages/view', 'slug' => $officialMessage->slug],
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
