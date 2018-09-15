<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OfficialMessage */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'OfficialMessage',
]) . ' ' . $model->title_en;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Official Message'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="article-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
