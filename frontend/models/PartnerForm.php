<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


class PartnerForm extends Model
{
    public $your_name;
    public $whattodo;
    public $website;
    public $type;
    public $type_fix;
    public $phone;
    public $email;
    public $short_desc;
    public $price;
    public $time;
    public $files;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['your_name', 'whattodo', 'email', 'price', 'time'], 'required'],
            [['price','time'], 'integer'],
            ['email', 'email'],
            ['website', 'url'],
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, txt, pdf, psd, zip, rar, odt', 'maxFiles' => 5, 'maxSize' => '25 * 1024 * 1024'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'your_name' => 'Вы кто?',
            'whattodo' => 'Что нужно?',
            'website' => 'Адрес сайта',
            'type' => 'Тип сайта (проекта)',
            'phone' => 'Телефон',
            'email' => 'Email',
            'short_desc' => 'Что-о-чем в нескольких предложениях',
            'price' => 'Ваша оценка (ч.)',
            'time' => 'Ваши сроки (дни)',
            'files' => 'ТЗ и сопутсвтующие файлы',
            'verifyCode' => 'Проверочный код',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        $this->files = UploadedFile::getInstances($this, 'files');
        $message = Yii::$app->mail->compose('partner')->setTo($email)
            ->setFrom([$email => $this->email.' - '.$this->your_name])
            ->setSubject($this->your_name.' Partners!!!');
        foreach ($this->files as $file) {
            $filename = 'uploads/forms/'.$file->baseName.' - '.Yii::$app->formatter->asDate('now', 'yyyy-MM-dd').'.'.$file->extension;
            $file->saveAs($filename);
            $message->attach($filename);
        }
        return $message->send();
    }
}
