<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\ContactForm;
use frontend\models\BriefForm;
use frontend\models\PartnerForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Field Brief.
     *
     * @return mixed
     */
    public function actionBrief()
    {
        $model = new BriefForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Спасибо за Вашу заявку! Мы обязательно с Вами свяжемся.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при отправки заявки!');
            }
        }

        return $this->render('brief', [
            'model' => $model,
        ]);
    }

    /**
     * Field for Partner.
     *
     * @return mixed
     */
    public function actionPartner()
    {
        $model = new PartnerForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Спасибо! В ближайшее время мы рассмотрим задание и свяжемся с Вами.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка!');
            }
        }

        return $this->render('partner', [
            'model' => $model,
        ]);
    }
}
