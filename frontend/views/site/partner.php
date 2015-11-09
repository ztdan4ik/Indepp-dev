<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\Pjax;
use common\widgets\Alert;

$this->title = 'Формец для партнеров';

$typeItems = array(
    'Интернет-магазин' => 'Интернет-магазин',
    'Портал' => 'Портал',
    'Бизнес-сайт' => 'Бизнес-сайт',
    'Корпоративный сайт' => 'Корпоративный сайт',
    'Сайт-визитка' => 'Сайт-визитка',
    'Онлайн-сервис' => 'Онлайн-сервис',
    'Промо-сайт' => 'Промо-сайт',
    'Другой' => 'Другой',
);
$whattodoItems = array(
    'Сайт с нуля' => 'Сайт с нуля',
    'Доработка(и)' => 'Доработка(и)',
);

?>
<?=Html::a( '&larr; На главную', Yii::$app->homeUrl, ['id' => 'history-back']) ?>
<div class="col-md-8 col-md-offset-2 cont-bg">
<h1 class="col"><?= Html::encode($this->title) ?></h1>
<p>
    Если у Вас есть для нас работенка - велком ту зис пейдж!
</p>
<?php Pjax::begin(['id' => 'partner-pjax']); ?>
    <?php $form = ActiveForm::begin(['id' => 'partner-form', 'options' => ['enctype' => 'multipart/form-data', 'data-pjax' => true]]); ?>
        <?= $form->field($model, 'your_name')->hint('Название студии или Ваше имя') ?>
        <?= $form->field($model, 'whattodo')->radioList($whattodoItems); ?>
        <?= $form->field($model, 'website')->textInput(['placeholder'=>'sitetodo.com'])->hint('При доработках')?>
        <?= $form->field($model, 'type')->dropDownList($typeItems, ['prompt'=>'Выберите тип']); ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'email')->textInput(['placeholder'=>'yourname@example.com']) ?>
        <?= $form->field($model, 'short_desc')->textarea(['rows'=>'5']) ?>
        <?= $form->field($model, 'price')->hint('Если Вам не был озвучен тариф - уточняйте') ?>
        <?= $form->field($model, 'time')?>
        <?= $form->field($model, 'files[]')->fileInput(['multiple' => true])->hint('doc, docx, txt, pdf, psd, zip, rar, odt - до 25 Мб') ?>
        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
        ]) ?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    <?= Alert::widget() ?>
<?php Pjax::end(); ?>
</div>
<?php
$this->registerJs("
jQuery('.field-partnerform-whattodo input').on('change', function(){
    if($(this).val() == 'Сайт с нуля'){
        jQuery('.field-partnerform-website').hide();
        jQuery('.field-partnerform-type').show();
    }else if($(this).val() == 'Доработка(и)'){
        jQuery('.field-partnerform-type').hide();
        jQuery('.field-partnerform-website').show();
    }
})
jQuery(document).on('pjax:start', function(){
    jQuery('form[data-pjax] button').attr('disabled','disabled');
})
");
?>

