<?php
use yii\web\UrlNormalizer;

return [
    'class' => 'codemix\localeurls\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'normalizer' => [
        'class' => 'yii\web\UrlNormalizer',
        // use temporary redirection instead of permanent for debugging
        'action' => UrlNormalizer::ACTION_REDIRECT_TEMPORARY,
    ],
    'languages' => ['hy', 'en', 'ru'],
    'rules'=> [

        //Site
        ['pattern'=>'hacax-trvog-harcer', 'route'=>'official-messages/faq'],
        ['pattern'=>'site/', 'route'=>'site/index'],
        ['pattern'=>'site/search', 'route'=>'site/search'],
        ['pattern'=>'contact', 'route'=>'site/contact'],
//        ['pattern'=>'site/subscription', 'route'=>'site/subscription'],
        ['pattern'=>'site/set-locale', 'route'=>'site/set-locale'],
        ['pattern'=>'site/captcha', 'route'=>'site/captcha'],
        ['pattern'=>'site/error', 'route'=>'site/error'],
        // Pages
//        ['pattern'=>'page/<slug>', 'route'=>'page/view'],
        //Events
        ['pattern'=>'news', 'route'=>'news/index'],
        ['pattern'=>'news/<slug>', 'route'=>'news/view'],
        //News
        ['pattern'=>'official-messages', 'route'=>'official-messages/index'],
        ['pattern'=>'hacax-trvog-harcer', 'route'=>'official-messages/faq'],
        ['pattern'=>'official-messages/<slug>', 'route'=>'official-messages/view'],
        // Articles
        ['pattern'=>'<category>/<slug>', 'route'=>'article/category-routing'],
        ['pattern'=>'<category>', 'route'=>'article/category-routing'],
        ['pattern'=>'article/attachment-download', 'route'=>'article/attachment-download'],
//
//      ['pattern'=>'article/<slug>', 'route'=>'article/view'],

        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']]
    ]
];
