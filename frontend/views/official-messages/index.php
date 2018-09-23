<?php
/* @var $this yii\web\View */


//------ SEO ------------
use frontend\models\search\GeneralSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('frontend', 'Official Messages');

$this->registerMetaTag([
    'name' => 'description',
    'content' => Yii::t('frontend', 'description'),
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => Yii::t('frontend', 'keywords'),
]);

//search
$searchModel = new GeneralSearch();
if (Yii::$app->getRequest()->getQueryParam('search') != null) {
    $searchModel->search = Yii::$app->getRequest()->getQueryParam('search');
}
?>

<div id="content" class="content">
    <div class="official-message-warp">
        <?= Html::a('<h2>'.Yii::t('frontend', 'Official Messages').'</h2>', ['official-messages/index'],
            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?>
        <?php echo \common\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'pager' => [
                'hideOnSinglePage' => true,
            ],
            'itemView' => '_item',
            'summary' => ''
        ]) ?>

    </div>
</div>
<div id="right_sidebar" class="right-sidebar">
    <div class="widget widget-search">
        <h2><?= Yii::t('frontend', 'Search')?> </h2>
        <?php if ($searchModel->search == null) { ?>
            <?php $form = ActiveForm::begin(); ?>
            <div class="search hidden-sm hidden-xs">
                <?= $form->field($searchModel, 'search')->textInput(['class' => 'search-input'])->label('')->label(false) ?>
            </div>
            <?php ActiveForm::end(); ?>
        <?php } ?>
    </div>
    <div class="widget widget-connect-us">
        <h2> <?= Yii::t('frontend', 'Connect  with us')?> </h2>
        <a class="connect" href="<?= Yii::$app->homeUrl?>/contact">
            <i class="icon-mail"></i>
            Contact US
        </a>
    </div>
</div>
<div class="clearfix"></div>