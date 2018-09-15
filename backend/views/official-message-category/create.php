<?php
/* @var $this yii\web\View */
/* @var $model common\models\NewsCategory */
/* @var $categories common\models\NewsCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Official Message Category',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Official Message Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
