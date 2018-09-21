<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */

?>
<div id="cont4act" class="conta4ct">
    <div class="news-wrap">
        <h2><?=Yii::t('frontend', 'Contact Us')?></h2>
        <div id="article_1" class="article">
            <?php $form = ActiveForm::begin(['id' => 'contact-form', 'enableClientValidation' => false]); ?>
            <div class="contact-form-item">
                <?php echo $form->field($model, 'name')->input('text', ['placeholder' => 'Your Name', 'class' => 'contact'])->label(false) ?>
            </div>
            <div class="contact-form-item">
                <?php echo $form->field($model, 'email')->input('text', ['placeholder' => 'Your Email', 'class' => 'contact'])->label(false) ?>
            </div>
            <div class="contact-form-item">
                <?php echo $form->field($model, 'body')->textArea(['rows' => 6, 'placeholder' => 'Your Message', 'class' => 'contact'])->label(false) ?>
            </div>
            <?php echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>
            <div class="contact-form-item">
                <?php echo Html::submitButton(Yii::t('frontend', 'send'), ['class' => 'main-btn', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<div class="clearfix"></div>