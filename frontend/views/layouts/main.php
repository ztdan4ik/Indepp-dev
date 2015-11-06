<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerCssFile('https://fonts.googleapis.com/css?family=Ubuntu'); ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="cover">
    <div class="cover-image" style="background-image: url('https://drscdn.500px.org/photo/50081308/m%3D2048/787ddf3a6d50e658c034d35e6b40a4fa');"></div>
    <div class="container">
        <div class="row">
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
