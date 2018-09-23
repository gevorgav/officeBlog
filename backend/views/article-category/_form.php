<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use trntv\filekit\widget\Upload;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleCategory */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $categories array */
?>

<div class="article-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <h3>Multilingual Inputs</h3>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu1">Հայերեն</a></li>
        <li ><a data-toggle="tab" href="#home">English</a></li>
        <li><a data-toggle="tab" href="#menu2">Русский</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade">
            <?php echo $form->field($model, 'title_en')->textInput(['maxlength' => 512]) ?>
            <?php echo $form->field($model, 'description_en')->textInput(['maxlength' => true]) ?>
            <?php echo $form->field($model, 'keywords_en')
                ->hint('Please enter the keyword with commas')
                ->textInput(['maxlength' => true]) ?>
        </div>
        <div id="menu1" class="tab-pane fade in active">
            <?php echo $form->field($model, 'title_hy')->textInput(['maxlength' => 512]) ?>
            <?php echo $form->field($model, 'description_hy')->textInput(['maxlength' => true]) ?>
            <?php echo $form->field($model, 'keywords_hy')
                ->hint('Please enter the keyword with commas')
                ->textInput(['maxlength' => true]) ?>
        </div>
        <div id="menu2" class="tab-pane fade">
            <?php echo $form->field($model, 'title_ru')->textInput(['maxlength' => 512]) ?>
            <?php echo $form->field($model, 'description_ru')->textInput(['maxlength' => true]) ?>
            <?php echo $form->field($model, 'keywords_ru')
                ->hint('Please enter the keyword with commas')
                ->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php echo $form->field($model, 'body')->textArea() ?>

    <?php echo $form->field($model, 'thumbnail')->widget(
        Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 5000000, // 5 MiB
        ]);
    ?>

    <?php echo $form->field($model, 'slug')
        ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
        ->textInput(['maxlength' => 1024]) ?>

<!--    --><?php //echo $form->field($model, 'parent_id')->dropDownList($categories, ['prompt'=>'']) ?>

    <?php echo $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
