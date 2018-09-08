<?php
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model common\models\Article */
$this->title = $model->getMultilingual('title', YII::$app->language);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

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

?>

<?php
    if ($model->thumbnail_path){
        $this->registerJs(
            "
        $( document ).ready(function() {
            $('.template').css( 'background-image', 'url(".$model->thumbnail_base_url.'/' . $model->thumbnail_path.")' );
            
        });",
            View::POS_READY
        );
    }

    //clean link data-target
    $this->registerJs(
        "
            $( document ).ready(function() {
                for(let link of $('.tmp_link')){
                    link.dataset.target = '';
                }
            });",
        View::POS_READY
    );
?>

<section class="template page-head section-img">
<!--    --><?php //if ($model->thumbnail_path): ?>
<!--        --><?php //echo \yii\helpers\Html::img(
//            Yii::$app->glide->createSignedUrl([
//                'glide/index',
//                'path' => $model->thumbnail_path,
//                'w' => 200
//            ], true),
//            ['class' => 'article-thumb img-rounded pull-left']
//        ) ?>
<!--    --><?php //endif; ?>
    <div class="gradient gradient-vr-56">
        <div class="container">
            <div class="text-block">
                <h1><?= $model->getMultilingual('title', Yii::$app->language) ?></h1>
                <p><?= $model->getMultilingual('short_description', Yii::$app->language) ?></p>
            </div>
        </div>
    </div>
</section>
<section class="template-text">




        <?php echo $model->getMultilingual('body', Yii::$app->language) ?>

        <?php if (!empty($model->articleAttachments)): ?>
            <h3><?php echo Yii::t('frontend', 'Attachments') ?></h3>
            <ul id="article-attachments">
                <?php foreach ($model->articleAttachments as $attachment): ?>
                    <li>
                        <?php echo \yii\helpers\Html::a(
                            $attachment->name,
                            ['attachment-download', 'id' => $attachment->id])
                        ?>
                        (<?php echo Yii::$app->formatter->asSize($attachment->size) ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
</section>