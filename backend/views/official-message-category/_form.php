<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NewsCategory */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $categories array */
?>

<div class="article-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <h3>Multilingual Inputs</h3>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu2">Հայերեն</a></li>
        <li ><a data-toggle="tab" href="#home">English</a></li>
        <li><a data-toggle="tab" href="#menu3">Русский</a></li>
    </ul>

    <div class="tab-content">
        <div id="menu2" class="tab-pane fade">
            <?php echo $form->field($model, 'title_hy')->textInput(['maxlength' => 512]) ?>
        </div>
        <div id="home" class="tab-pane fade in active">
            <?php echo $form->field($model, 'title_en')->textInput(['maxlength' => 512]) ?>
        </div>
        <div id="menu3" class="tab-pane fade">
            <?php echo $form->field($model, 'title_ru')->textInput(['maxlength' => 512]) ?>
        </div>
    </div>

    <?php echo $form->field($model, 'slug')
        ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
        ->textInput(['maxlength' => 1024]) ?>

    <?php echo $form->field($model, 'parent_id')->dropDownList($categories, ['prompt'=>'']) ?>

    <?php echo $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
