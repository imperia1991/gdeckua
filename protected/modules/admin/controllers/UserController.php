<?php

class UserController extends AdminController
{
    public function filters()
    {
        return [
            'accessControl', // perform access control for CRUD operations
        ];
    }

    public function accessRules()
    {
        return [
            ['allow',
                'roles' => ['admin'],
            ],
            ['deny', // deny all users
                'users' => ['*'],
            ],
        ];
    }

    public function init()
    {
        parent::init();

        $this->menuActive = 'user';
    }
    public function actionIndex()
    {
        $model = new Users();

        if (Yii::app()->request->isAjaxRequest) {
            $get = Yii::app()->request->getQuery('Users');

            $model->setAttributes($get);
            $model->rule = isset($get['rule']) ? trim($get['rule']) : '';
        }

        $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $model = Users::model()->findByPk((int) $id);
        $model->scenario = Users::SCENARIO_ADMIN;

        $this->processForm($model);
    }

    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            Users::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Пользователь удален');

            Yii::app()->end();
        }
    }

    private function processForm($model)
    {
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Users');
            $postRulesUsers = Yii::app()->request->getPost('RulesUsers');
            $model->attributes = $post;
            $model->ruleId = (int)$postRulesUsers['rule_id'];

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Данные о пользователе сохранены');

                $this->redirect($this->createUrl('/admin/user'));
            }
        }

        $rules = CHtml::listData(Rules::model()->findAll('status=1'), 'id', 'description');

        $this->render('user', [
            'model' => $model,
            'rules' => $rules,
        ]);
    }
}