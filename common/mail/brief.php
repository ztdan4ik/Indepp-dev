<?php
/**
 * Created by PhpStorm.
 * User: Вадим
 * Date: 02.11.2015
 * Time: 15:37
 */

$model = new \frontend\models\BriefForm;
$data = \Yii::$app->request->post('BriefForm');

foreach($model->attributeLabels() as $key => $value){
    if($key != 'files' and $key != 'verifyCode')
    echo $data[$key] ? '<p><strong>'.$value.'</strong>: '.$data[$key].'</p>': null;
}