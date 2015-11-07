<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'Indepp Team';
?>

<div class="col-md-6 col-md-offset-3 text-center main-bg">
    <h1 class="primary">INDEPP TEAM</h1>
    <p class="primary">
        Independent Programmers Team
    </p>
    <ul class="list-inline m-menu">
        <li><a href="<?=Url::toRoute('/site/about');?>">О нас</a></li>
        <li><a href="<?=Url::toRoute('/site/brief');?>">Заполнить Бриф</a></li>
        <?php /* <li><a href="<?=Url::toRoute('/site/partner');?>">Партнерка</a></li> */ ?>
        <li><a href="<?=Url::toRoute('/site/test');?>">Тест</a></li>
    </ul>
</div>
