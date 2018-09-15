<?php
/* @var $this yii\web\View
 * @var $slider common\models\Slider
 * @var $upcoming common\models\Event
 * @var $configs common\models\HomePageConfigs
 */
$this->title = Yii::$app->name;

use yii\web\View;
use yii\helpers\Html;
?>

<?php

?>

<div id="content" class="content">
    <div class="news-wrap">
        <h2>News</h2>
        <?php foreach ($newsList as $news): ?>
            <div id="article_1" class="article">
                <div class="thumbnail">
                    <a href="#pashinyans-interviewwith-euronews">
                        <img src="<?=$news->preview_base_url.'/' . $news->preview_path?>" />
                    </a>
                </div>
                <time><?php echo Yii::$app->formatter->asDate($news->published_at, "d MMM, y HH:MM") ?></time>
                <a href="#pashinyans-interviewwith-euronews">
                    <h3><?= $news->getMultilingual('title', YII::$app->language)?></h3>
                </a>
                <p>
                    <?= $news->getMultilingual('short_description', YII::$app->language)?>
                </p>
            </div>
        <?php endforeach; ?>
        <div class="all-news clearfix"><a href="#all-news">All News</a></div>
    </div>
    <div class="official-message-warp">
        <h2>Official message</h2>
        <div id="official_message" class="official-message">
            <time>18 Aug, 2018 11:21</time>
            <a href="#the-armenian-anomaly">
                <h3>The Armenian Anomaly</h3>
            </a>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                unknown printer took a galley of type and scrambled it to ...
            </p>
        </div>
        <div id="official_message" class="official-message">
            <time>18 Aug, 2018 11:21</time>
            <a href="#the-armenian-anomaly">
                <h3>The Armenian Anomaly</h3>
            </a>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                unknown printer took a galley of type and scrambled it to ...
            </p>
        </div>
        <div id="official_message" class="official-message">
            <a href="#the-armenian-anomaly">
                <time>18 Aug, 2018 11:21</time>
            </a>
            <h3>The Armenian Anomaly</h3>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                unknown printer took a galley of type and scrambled it to ...
            </p>
        </div>
        <div class="see-all clearfix"><a href="#see-all">See All</a></div>
    </div>
</div>
