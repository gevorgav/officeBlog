<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 20.11.2017
 * Time: 20:46
 */

# var mo
namespace frontend\controllers;


use backend\models\search\OfficialMessageSearch;
use common\models\Article;
use common\models\News;
use common\models\OfficialMessage;
use frontend\models\search\NewsSearch;
use frontend\models\search\GeneralSearch;
use yii\helpers\Html;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OfficialMessagesController extends Controller
{

    public function beforeAction($action){
        $model = new GeneralSearch();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $search = Html::encode($model->search);
            return $this->redirect(Yii::$app->urlManager->createUrl(['site/search', 'search' => $search]));
        }
        return true;
    }
    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OfficialMessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['published_at' => SORT_DESC]
        ];
        $dataProvider->pagination->pageSize = 5;
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        $model = OfficialMessage::find()->published()->andWhere(['slug' => $slug])->one();
        $latestNews = OfficialMessage::find()
            ->published()
            ->orderBy(['{{%official_message}}.published_at' => SORT_DESC])
            ->limit(3)
            ->all();

        if (!$model) {
            throw new NotFoundHttpException;
        }

        $viewFile = $model->view ?: 'view';
        return $this->render($viewFile, ['model' => $model, 'latestNews' => $latestNews]);
    }
}