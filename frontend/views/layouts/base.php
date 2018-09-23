<?php

use yii\bootstrap\Nav;
use common\models\Event;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\search\GeneralSearch;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php');


//if (Yii::$app->getRequest()->getQueryParam('search') != null) {
//    $model->search = Yii::$app->getRequest()->getQueryParam('search');
//}


?>
    <header id="header" class="header">
        <div class="left-side">
            <div class="p-central">
                <a class="logo" href="<?= Yii::$app->homeUrl?>"></a>
                <a href="<?= Yii::$app->homeUrl?>">
                    <h1 id="site_name" class="site-name">
                        <?=Yii::t('frontend', 'ARTSAKH REPUBLIC NATIONAL SECURITY SERVICE')?>
                    </h1>
                </a>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="right-side">
            <ul id="languages" class="languages">
                <?php foreach (Yii::$app->params['availableLocales'] as $code => $item): ?>
                    <li class="<?=Yii::$app->language === $code?'current': ''?>"><?=Html::a($item, ['/site/set-locale', 'locale' => $code], []);?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </header>

    <main id="main" class="main">
        <div id="left_sidebar" class="left-sidebar">
            <h2><?=Yii::t('frontend', 'Official website')?><span id="nav_open_toggle" class="nav-open-toggle" data-open="false"></span> </h2>
            <nav id="left_sidebar_navigation" class="left-sidebar-navigation">
                <ul>
<!--                    <li class="has-submenu">-->
<!--                        <a href="#structure">Structure</a>-->
<!--                        <ul class="sub-menu">-->
<!--                            <li><a href="#structure-1">Structure submenu 1</a></li>-->
<!--                            <li><a href="#structure-2">Structure submenu 2</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li><?= Html::a(Yii::t('frontend', 'Home page'), ['site/index'],
                            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'News'), ['news/index'],
                            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'Official messages'), ['official-messages/index'],
                            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'Legislation'), ['official-messages/index'],
                            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'Leadership'), ['official-messages/index'],
                            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'Structure'), ['official-messages/index'],
                            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'Symbolic'), ['official-messages/index'],
                            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'FAQ'), ['/hacax-trvog-harcer'],
                            ['class' => 'calendar-visit-event', 'style' => 'text-decoration: none']) ?></li>
<!--                    <li class="current has-submenu">-->
<!--                        <a href="#news">News</a>-->
<!--                        <ul class="sub-menu">-->
<!--                            <li><a href="#submenu-1">News submenu 1</a></li>-->
<!--                            <li><a href="#submenu-2">News submenu 2</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->

                </ul>
            </nav>
        </div>

        <?php echo $content ?>
    </main>


    <footer id="footer" class="footer">
        <div class="container">
            <div class="widget feedback">
                <h4><?=Yii::t('frontend', 'Feedback')?></h4>
                <ul>
                    <li>0010 Yerevan, Vazgen Sargsyan St., 3/8 Building,</li>
                    <li>Tel.+374 10 59-40-94,</li>
                    <li>Fax: +374 10 59 40 00</li>
                </ul>
            </div>
            <div class="widget hot-line-numbers">
                <h4>Hot line numbers</h4>
                <ul>
                    <li><span class="left"><?=Yii::t('frontend', 'ARTSAKH REPUBLIC NATIONAL SECURITY SERVICE')?>։</span> <span
                                class="right">(+374) 10 59-41-48</span></li>
                    <li><span class="left">Compulsory Enforcement Service։</span> <span class="right">(+374 ) 10 34-22-29</span>
                    </li>
                    <li><span class="left">Penitentiary Service։ </span> <span class="right">(+374 ) 10 44-22-73</span>
                    </li>
                </ul>
            </div>
            <div class="widget follow-us">
                <h4>Follow us</h4>
                <ul>
                    <li><a href="#facebook"><i class="icon-facebook"></i></a></li>
                    <li><a href="#twitter"><i class="icon-twitter"></i></a></li>
                    <li><a href="#linkedin"><i class="icon-linkedin"></i></a></li>
                    <li><a href="#social-rss"><i class="icon-social-rss"></i></a></li>
                </ul>
            </div>
            <div class="copyright">
                Copyright 2018 All rights reserved| Ministry of Justice of RA
            </div>
        </div>
    </footer>
<?php $this->endContent() ?>