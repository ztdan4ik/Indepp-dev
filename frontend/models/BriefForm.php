<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


class BriefForm extends Model
{
    public $your_name;
    public $company_name;
    public $phone;
    public $email;
    public $website;
    public $field_activity;
    public $type;
    public $goal;
    public $example;
    public $languages;
    public $files;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['your_name', 'email'], 'required'],
            ['email', 'email'],
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, txt, pdf, psd', 'maxFiles' => 5],
            ['verifyCode', 'captcha'],
        ];
    }

    /** 
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'your_name' => 'Ваше имя',
            'company_name' => 'Название компании/фирмы',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'website' => 'Адрес сайта',
            'field_activity' => 'Сфера деятельности',
            'type' => 'Тип сайта (проекта)',
            'goal' => 'Цель создания сайта и его аудитория («Каких результатов хотите достичь?»)',
            'example' => 'Примеры понравившихся сайтов/сайтов конкурентов',
            'languages' => 'Языки',
            'files' => 'Материалы для сайта',
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
        $message = Yii::$app->mail->compose('brief')->setTo(Yii::$app->params['adminEmail'])
            ->setFrom([$email => $this->email.' - '.$this->company_name])
            ->setSubject($this->your_name.' Brief!!!');
        foreach ($this->files as $file) {
            $filename = 'uploads/briefs/'.$file->baseName.' - '.Yii::$app->formatter->asDate('now', 'yyyy-MM-dd').'.'.$file->extension;
            $file->saveAs($filename);
            $message->attach($filename);
        }
        return $message->send();
    }
}
