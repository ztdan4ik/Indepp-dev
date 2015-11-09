<?php

use yii\helpers\Html;


$this->title = 'Контакты';
?>
<?= Html::a('&larr; На главную', Yii::$app->homeUrl, ['id' => 'history-back']) ?>

<div class="col-md-8 col-md-offset-2 cont-bg">
    <h1 class="col"><?= Html::encode($this->title) ?></h1>

    <div>
        <p><strong>Наш адрес</strong>: Украина, г. Житомир, ул. Рыльского, 9</p>
        <p><strong>Телефоны</strong>:<br/>
        +38 (097) 133-84-38<br/>
        +38 (063) 597-14-59<br/></p>
        <p><strong>E-mail</strong>: info@inde.pp.ua</p>
        <p><strong>Skype</strong>: indepp.team</p>
        <p><strong>ICQ</strong>: 508360</p>
        </p>&nbsp;</p>
        <div id="gmap"></div>
    </div>
</div>
