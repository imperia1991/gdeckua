<?php

/**
 * Class SiteController
 */
class SiteController extends Controller
{

    /**
     * @return array
     */
    public function filters()
    {
        return [
            'accessControl', // perform access control for CRUD operations
        ];
    }

    /**
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow',
                'actions' => ['index', 'add', 'view', 'upload', 'deletePreviewUpload', 'feedback', 'about', 'signin', 'signup', 'captcha', 'error'],
                'roles' => ['guest'],
            ],
            ['allow',
                'actions' => ['add', 'logout'],
                'roles' => ['user', 'admin'],
            ],
            ['deny', // deny all users
                'actions' => ['logout'],
                'users' => ['*'],
            ],
        ];
    }

    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->currentPageType = PageTypes::PAGE_DEFAULT;

        Yii::import('application.extensions.LocoTranslitFilter');
    }

//    /**
//     * Declares class-based actions.
//     */
//    public function actions()
//    {
//        return [
//            // captcha action renders the CAPTCHA image displayed on the contact page
//            'captcha' => [
//                'class' => 'CCaptchaAction',
//                'backColor' => 0x494949,
//                'foreColor' => 0xFFFFFF
//            ],
//        ];
//    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $modelsNews = News::model()->getPreview();
        $modelsPhotoCity = PhotoCity::model()->getPreview();
        $categories = CategoryPosters::model()->getAll();

        $modelPosters = new Posters();

        $this->render(
            'index',
            [
                'places' => Places::model()->getForMainPage()->getData(),
                'modelNews' => $modelsNews,
                'modelsPhotoCity' => $modelsPhotoCity,
                'categories' => $categories,
                'modelPosters' => $modelPosters->getForMainPage(),
            ]
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if (isset($_GET['object'])) {
            $id = Yii::app()->request->getQuery('object', 0);
            if ($id) {
                $placeModel = Places::model()->findByPk($id);

                if ($placeModel) {
                    $this->redirect(Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/view/' . $placeModel->id . '/' . $placeModel->alias));
                }
            }
        }

        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('/system/error' . $error['code'], $error);
            }
        }
    }

    /**
     * Обратная связь
     */
    public function actionFeedback()
    {
        $model = new Feedback();
        $model->setAttributes(Yii::app()->request->getPost('Feedback', []));
        $model->message = nl2br($model->message);

        if ($model->save()) {
            $message = new YiiMailMessage;
            $message->view = 'feedback';
            $message->setBody(['model' => $model], 'text/html');
            $message->subject = 'gde.ck.ua: Обратная связь';
            $message->addTo('support@gde.ck.ua');
            $message->from = $model->email;

            Yii::app()->mail->send($message);

            Yii::app()->user->setFlash(
                'success',
                Yii::t('main', 'Спасибо. Ваше письмо отправлено. Мы ответим Вам в ближайшее время')
            );

            $this->respondJSON(
                [
                    'error' => 0,
                ]
            );
        } else {
            $this->respondJSON(
                [
                    'error' => 1,
                    'errors' => $model->getErrors(),
                ]
            );
        }

        Yii::app()->end();
    }

    /**
     * О проекте
     */
    public function actionAbout()
    {
        $this->currentPageType = PageTypes::PAGE_ABOUT;

        $settingsModel = Settings::model()->find();

        $this->render(
            'about',
            [
                'settingsModel' => $settingsModel
            ]
        );
    }

    /**
     * Авторизация
     */
    public function actionSignin()
    {
        $modelUser = new Users(Users::SCENARIO_LOGIN);

        if (Yii::app()->getRequest()->isPostRequest) {
            $post = Yii::app()->getRequest()->getPost('Users', []);

            $modelUser->setAttributes($post);

            if ($modelUser->validate() && $modelUser->login()) {
                Yii::app()->getRequest()->redirect(Yii::app()->session['returnUrl']);
            } else {
                Yii::app()->user->setFlash('error', Yii::t('main', 'Вы допустили ошибки при авторизации'));
            }

        }

        $this->render('signin',[
                'modelUser' => $modelUser,
            ]);
    }

    /**
     * Регистрация
     */
    public function actionSignup()
    {
        $modelUserRegister = new Users(Users::SCENARIO_REGISTER);

        if (Yii::app()->getRequest()->isPostRequest) {
            $post = Yii::app()->getRequest()->getPost('Users', []);

            $modelUserRegister->setAttributes($post);

            if ($modelUserRegister->validate()) {
                $modelUserRegister->save(false);

                $mailWraper = new MailWrapper();
                $mailWraper->setModel($modelUserRegister);
                $mailWraper->setView('register_' . Yii::app()->getLanguage());
                $mailWraper->setSubject(Yii::t('main', 'Регистрация на сайте'));
                $mailWraper->send();

                $modelUserRegister->password = $modelUserRegister->passwordRepeat;
                $modelUserRegister->login();

                Yii::app()->user->setFlash('success', Yii::t('main', 'Спасибо. Вы зарегистрированы на сайте'));

                Yii::app()->getRequest()->redirect(Yii::app()->session['returnUrl']);
            } else {
                Yii::app()->user->setFlash('error', Yii::t('main', 'Вы допустили ошибки при регистрации'));
            }
        }

        $this->render('signup',[
                'modelUserRegister' => $modelUserRegister,
            ]);
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionForgot()
    {
        $modelUserForgot = new Users(Users::SCENARIO_FORGOT);

        if (Yii::app()->getRequest()->isPostRequest) {
            $post = Yii::app()->getRequest()->getPost('Users', []);

            $modelUserForgot->setAttributes($post);

            if ($modelUserForgot->validate()) {
                /** @var Users $modelCurrentUser */
                $modelCurrentUser = Users::model()->findByAttributes([
                        'email' => $modelUserForgot->email,
                    ]);

                $modelCurrentUser->passwordRepeat = StringHelper::getPassword();
                $modelCurrentUser->password = md5($modelCurrentUser->passwordRepeat);

                if ($modelCurrentUser->save(false)) {
                    $mailWraper = new MailWrapper();
                    $mailWraper->setModel($modelCurrentUser);
                    $mailWraper->setView('forgot_' . Yii::app()->getLanguage());
                    $mailWraper->setSubject(Yii::t('main', 'Востановление пароля'));
                    $mailWraper->send();
                }

                Yii::app()->user->setFlash('success',
                    Yii::t('main', 'На Ваш электронный адрес {email} выслано письмо с новым паролем', [
                        '{email}' => $modelCurrentUser->email
                    ]));

                Yii::app()->getRequest()->redirect('/' . Yii::app()->getLanguage() . '/signin');
            } else {
            }

        }

        $this->render('forgot',[
                'modelUserForgot' => $modelUserForgot,
            ]);
    }

}