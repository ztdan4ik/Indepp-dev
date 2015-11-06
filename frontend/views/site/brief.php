<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\Pjax;
use common\widgets\Alert;

$this->title = 'Бриф на разработку';

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
$lgItems = array(
    'Одноязычный' => 'Одноязычный',
    'Мультиязычный' => 'Мультиязычный',
);
$goalItems = array(
    'Увеличение посещаемости, развитие проекта' => 'Увеличение посещаемости, развитие проекта',
    'Продвижение конкретных продуктов и услуг' => 'Продвижение конкретных продуктов и услуг',
    'Улучшение имиджа' => 'Улучшение имиджа',
    'Продажи через интернет, приём платежей' => 'Продажи через интернет, приём платежей',
    'Сервисы для сотрудников компании' => 'Сервисы для сотрудников компании)',
    'Сервисы для клиентов и/или партнёров' => 'Сервисы для клиентов и/или партнёров)',
);

?>
<?=Html::a( '&larr; На главную', Yii::$app->homeUrl, ['id' => 'history-back']) ?>
<div class="col-md-8 col-md-offset-2 cont-bg">
<h1 class="col"><?= Html::encode($this->title) ?></h1>
<p>
    Заполните бриф и мы свяжемся с Вами в ближайшее время!
</p>
<?php Pjax::begin(['id' => 'brief-pjax']); ?>
    <?php $form = ActiveForm::begin(['id' => 'brief-form', 'options' => ['enctype' => 'multipart/form-data', 'data-pjax' => true]]); ?>
        <?= $form->field($model, 'your_name') ?>
        <?= $form->field($model, 'company_name') ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'email')->textInput(['placeholder'=>'yourname@example.com']) ?>
        <?= $form->field($model, 'website')->textInput(['placeholder'=>'yoursite.com'])->hint('Если требуется доработка существующего сайта') ?>
        <?= $form->field($model, 'field_activity') ?>
        <?= $form->field($model, 'type')->dropDownList($typeItems, ['prompt'=>'Выберите тип']); ?>
        <?= $form->field($model, 'goal')->dropDownList($goalItems, ['prompt'=>'Выберите цель']); ?>
        <?= $form->field($model, 'example')->textarea()->hint('Через запятую') ?>
        <?= $form->field($model, 'languages')->radioList($lgItems) ?>
        <?= $form->field($model, 'files[]')->fileInput(['multiple' => true])->hint('Техническое задание, макеты') ?>
        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
        ]) ?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= Alert::widget() ?>
    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
</div>
<?php
$this->registerJs("
jQuery(document).on('pjax:start', function(){
    jQuery('form[data-pjax] button').attr('disabled','disabled');
})
");
?>

