<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 30.10.2017
 * Time: 15:58
 */

namespace frontend\controllers;

use common\models\News;
use common\models\OfficialMessage;
use common\models\OfficialMessageCategory;
use frontend\models\search\NewsSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\search\GeneralSearch;
use yii\helpers\Html;

class NewsController extends Controller
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
        $category = OfficialMessageCategory::find()->andWhere(['slug' => 'official-message'])->one();
        $officialMessages = OfficialMessage::find()
            ->andWhere(['{{%official_message}}.category_id' => $category->id])
            ->published()
            ->orderBy(['{{%official_message}}.published_at' => SORT_DESC])
            ->limit(3)
            ->all();

        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['published_at' => SORT_DESC]
        ];
        $dataProvider->pagination->pageSize = 5;
        return $this->render('index', ['dataProvider' => $dataProvider, 'officialMessages' => $officialMessages]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        $model = News::find()->published()->andWhere(['slug' => $slug])->one();
        $upcoming = News::find()
            ->published()
            ->orderBy(['{{%news}}.published_at' => SORT_DESC])
            ->limit(3)
            ->all();
        if (!$model) {
            throw new NotFoundHttpException;
        }

        $viewFile = $model->view ?: 'view';
        return $this->render($viewFile, ['model' => $model,'upcoming' => $upcoming]);
    }
}