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
use common\models\OfficialMessageCategory;
use frontend\models\search\NewsSearch;
use frontend\models\search\GeneralSearch;
use yii\data\ActiveDataProvider;
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
        $category = OfficialMessageCategory::find()->andWhere(['slug' => 'official-message'])->one();
        $query = OfficialMessage::find()->where(['category_id' => $category->id]);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC]
            ],
        ]);

        return $this->render('index', ['dataProvider' => $provider]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        $category = OfficialMessageCategory::find()->andWhere(['slug' => 'official-message'])->one();

        $model = OfficialMessage::find()->published()->andWhere(['slug' => $slug])->one();
        $latestNews = OfficialMessage::find()
            ->andWhere(['{{%official_message}}.category_id' => $category->id])
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

    public function actionFaq()
    {
        $category = OfficialMessageCategory::find()->andWhere(['slug' => 'official-message'])->one();

        $officialMessages = OfficialMessage::find()
            ->andWhere(['{{%official_message}}.category_id' => $category->id])
            ->published()
            ->orderBy(['{{%official_message}}.published_at' => SORT_DESC])
            ->limit(3)
            ->all();

        $categoryModel = OfficialMessageCategory::find()->andWhere(['slug' => 'hacax-trvog-harcer'])->one();

        $modelList = OfficialMessage::find()
            ->andWhere(['{{%official_message}}.category_id' => $categoryModel->id])
            ->published()
            ->orderBy(['{{%official_message}}.published_at' => SORT_DESC])
            ->all();

        return $this->render('faq', ['modelList' => $modelList, 'officialMessages' => $officialMessages]);
    }
}