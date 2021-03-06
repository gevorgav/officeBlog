<?php
namespace frontend\controllers;

use common\models\Event;
use common\models\OfficialMessage;
use common\models\OfficialMessageCategory;
use frontend\models\search\GeneralSearch;
use Yii;
use frontend\models\ContactForm;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\web\Controller;
use common\models\Article;
use common\models\ArticleCategory;
use yii\data\ActiveDataProvider;
use common\models\HomePageConfigs;
use common\models\Slider;
use common\models\News;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'set-locale' => [
                'class' => 'common\actions\SetLocaleAction',
                'locales' => array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    public function beforeAction($action){
        $model = new GeneralSearch();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $search = Html::encode($model->search);
            return $this->redirect(Yii::$app->urlManager->createUrl(['site/search', 'search' => $search]));
        }
        return true;
    }

    public function actionIndex()
    {
        $newsList = News::find()
            ->published()
            ->orderBy(['{{%news}}.published_at' => SORT_DESC])
            ->limit(3)
            ->all();

        $category = OfficialMessageCategory::find()->andWhere(['slug' => 'official-message'])->one();
        $officialMessages = OfficialMessage::find()
            ->andWhere(['{{%official_message}}.category_id' => $category->id])
            ->published()
            ->orderBy(['{{%official_message}}.published_at' => SORT_DESC])
            ->limit(3)
            ->all();

        return $this->render('index', [
            'newsList' => $newsList,
            'officialMessages' => $officialMessages,
        ]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
//                Yii::$app->getSession()->setFlash('alert', [
//                    'body' => Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
//                    'options' => ['class' => 'alert-success']
//                ]);
                return $this->refresh();
            } else {
//                Yii::$app->getSession()->setFlash('alert', [
//                    'body' => \Yii::t('frontend', 'There was an error sending email.'),
//                    'options' => ['class' => 'alert-danger']
//                ]);
            }
        }

        return $this->render('contact', [
            'model' => $model
        ]);
    }

    public function actionSearch(){
        $search = Yii::$app->getRequest()->getQueryParam('search');
        $query = News::find()->published()->where(['like', 'title_'.Yii::$app->language, $search])->where(['like', 'body_'.Yii::$app->language, $search]);
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query->count()
        ]);

        $newsList = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('search',[
            'newsList' => $newsList,
            'search' => $search,
            'pagination' => $pagination
        ]);
    }


}
