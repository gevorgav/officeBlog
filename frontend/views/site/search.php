<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 25.03.2018
 * Time: 1:08
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\search\GeneralSearch;
use yii\widgets\LinkPager;

$this->title = Yii::t('frontend', 'Search') . " " . $search;


$this->registerMetaTag([
    'name' => 'description',
    'content' => Yii::t('frontend', 'Search') . " :" . $search,
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $search,
]);

$model = new GeneralSearch();
if (Yii::$app->getRequest()->getQueryParam('search') != null) {
    $model->search = Yii::$app->getRequest()->getQueryParam('search');
}
?>


    <div id="contact" class="contact">
        <div class="row">
            <?php $form = ActiveForm::begin(); ?>
                <div class="col-md-10">
                    <?= $form->field($model, 'search')->textInput(['placeholder' => Yii::t('frontend', 'Search')])->label(false) ?>
                </div>
                <div class="col-md-2">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        <?php if ($search == "" || count($newsList) == 0) { ?>
            <div class="row">
                <div class="item">
                    <div class="col-md-12 col-sm-12  col-xs-12 item-information">
                        <h4><?= Yii::t('frontend', 'No results found'); ?></h4>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="news-wrap">
                <?= Yii::t('frontend', 'Search results'); ?>
                <?php foreach ($newsList as $news): ?>
                    <div id="article_1" class="article">
                        <time><?php echo Yii::$app->formatter->asDate($news->published_at, "d MMM, y HH:MM") ?></time>
                        <?= Html::a('<h3>' . $news->getMultilingual('title', YII::$app->language) . '</h3>', ['news/view', 'slug' => $news->slug],
                            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
                        <?= Html::a('<p>' . $news->getMultilingual("short_description", YII::$app->language) . '</p>', ['news/view', 'slug' => $news->slug],
                            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php } ?>
        <?php echo LinkPager::widget([
            'pagination' => $pagination,
        ]); ?>
    </div>
<div class="clearfix"></div>