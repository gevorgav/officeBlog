<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $categories common\models\NewsCategory[] */

$this->title = Yii::t('backend', 'Create Official Message', [
    'modelClass' => 'OfficialMessage',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Official Message'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
