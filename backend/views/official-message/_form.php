<?php

use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use pudinglabs\tagsinput\TagsinputWidget;


/* @var $this yii\web\View */
/* @var $model common\models\OfficialMessage */
/* @var $categories common\models\OfficialMessageCategory[] */
/* @var $form yii\bootstrap\ActiveForm */

?>

<div class="article-form">
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?php echo $form->field($model, 'slug')
                ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
                ->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'published_at')->widget(
                DateTimeWidget::className(),
                [
                    'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ'
                ]
            ) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'status')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?php echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
                $categories,
                'id',
                'title_hy'
            ), ['prompt' => '']) ?>
        </div>
    </div>


    <div class="">
        <h3>Multilingual inputs</h3>
        <ul class="nav nav-tabs">

            <li class="active"><a data-toggle="tab" href="#menu2">Հայերեն</a></li>
            <li><a data-toggle="tab" href="#home">English</a></li>
            <li><a data-toggle="tab" href="#menu3">Русский</a></li>
        </ul>

        <div class="tab-content">
            <div id="menu2" class="tab-pane fade in active">
                <?php echo $form->field($model, 'title_hy')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_hy')->textArea(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'body_hy')->textArea(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'keywords_hy')
                    ->hint('Please enter the keyword with commas')
                    ->textInput(['maxlength' => true]) ?>

            </div>
            <div id="home" class="tab-pane fade ">
                <?php echo $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_en')->textArea(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'body_en')->textArea(['maxlength' => true])?>
                <?php echo $form->field($model, 'keywords_en')
                    ->hint('Please enter the keyword with commas')
                    ->textInput(['maxlength' => true]) ?>
            </div>
            <div id="menu3" class="tab-pane fade">
                <?php echo $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_ru')->textArea(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'body_ru')->textArea(['maxlength' => true])?>
                <?php echo $form->field($model, 'keywords_ru')
                    ->hint('Please enter the keyword with commas')
                    ->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>


    <div class="articles-fixed-part">
        <div class="form-group">
            <?php echo Html::submitButton(
                $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'onclick' => 'updateForm()']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>