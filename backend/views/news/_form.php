<?php
use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use pudinglabs\tagsinput\TagsinputWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $categories common\models\ArticleCategory[] */
/* @var $form yii\bootstrap\ActiveForm */


//$this->registerJsFile('/js/map.js');
//
//$this->registerJsFile(
//    'https://maps.googleapis.com/maps/api/js?key=AIzaSyAEHv8JbWzo_67F0eZxQ5niDBpTKqfN7Ec&callback=init'
//);

?>


<div class="article-form">
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
            <?php echo $form->field($model, 'preview')->widget(
                Upload::className(),
                [
                    'url' => ['/file-storage/upload'],
                    'maxFileSize' => 5000000, // 5 MiB
                ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'thumbnail')->widget(
                Upload::className(),
                [
                    'url' => ['/file-storage/upload'],
                    'maxFileSize' => 5000000, // 5 MiB
                ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'attachments')->widget(
                Upload::className(),
                [
                    'url' => ['/file-storage/upload'],
                    'sortable' => true,
                    'maxFileSize' => 10000000, // 10 MiB
                    'maxNumberOfFiles' => 10
                ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($model, 'video_link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?=
            $form->field($model, 'tags')->widget(TagsinputWidget::classname(), [
                'options' => [],
                'clientOptions' => [],
                'clientEvents' => []
            ]);
            ?>
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
    <div class="clear"></div>
    <div>
        <h3 style="margin-top: 36px;">Multilingual inputs</h3>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#menu2">Հայերեն</a></li>
            <li><a data-toggle="tab" href="#home">English</a></li>
            <li><a data-toggle="tab" href="#menu3">Русский</a></li>
        </ul>

        <div class="tab-content">
            <div id="menu2" class="tab-pane fade in active">
                <?php echo $form->field($model, 'title_hy')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_hy')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'body_hy')->textArea() ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'keywords_hy')->hint('Please enter the keyword with commas')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <div id="home" class="tab-pane fade ">
                <?php echo $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_en')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'body_en')->textArea() ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'keywords_en')
                            ->hint('Please enter the keyword with commas')
                            ->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <div id="menu3" class="tab-pane fade">
                <?php echo $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_ru')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'body_ru')->textArea() ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'keywords_ru')->hint('Please enter the keyword with commas')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?php echo Html::submitButton(
            $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
