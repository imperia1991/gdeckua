<?php

/**
 * Class RssController
 */
class RssController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->menuActive = 'rss';

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     *
     */
    public function actionIndex()
    {
        $rssSitesModel = new RssSites();

        if (Yii::app()->request->isAjaxRequest) {
            $params = Yii::app()->request->getParam('RssSites');

            $rssSitesModel = new RssSites('search');
            $rssSitesModel->setAttributes($params);
        }

        $this->render(
            'index',
            [
                'rssSitesModel' => $rssSitesModel,
            ]
        );
    }

    /**
     *
     */
    public function actionCreate()
    {
        $rssSitesModel = new RssSites();

        $this->processForm($rssSitesModel);
    }

    /**
     *
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $rssSitesModel = RssSites::model()->findByPk((int)$id);

        $this->processForm($rssSitesModel);
    }

    /**
     *
     */
    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            RssSites::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Сайт удален');

            Yii::app()->end();
        }
    }
    /**
     *
     */
    public function actionNews()
    {
        $rssContentModel = new RssContent();

        if (Yii::app()->request->isAjaxRequest) {
            $params = Yii::app()->request->getParam('RssContent');

            $rssContentModel = new RssContent('search');
            $rssContentModel->setAttributes($params);
        }

        $this->render(
            'news',
            [
                'rssContentModel' => $rssContentModel,
            ]
        );
    }

    /**
     * @param RssSites $rssSitesModel
     */
    private function processForm($rssSitesModel)
    {
        /** @var CategoryNews $rssSitesModel */
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('RssSites');

            $isNewRecord = $rssSitesModel->isNewRecord;
            $transaction = $rssSitesModel->dbConnection->beginTransaction();

            try {
                /** @var RssSites $rssSitesModel */
                $rssSitesModel->setAttributes($post);
                $rssSitesModel->alias = LocoTranslitFilter::cyrillicToLatin($rssSitesModel->title);

                if ($rssSitesModel->save()) {
                    $transaction->commit();

                    Yii::app()->user->setFlash(
                        'success',
                        $isNewRecord ? 'Сайт добавлен' : 'Сайт изменен'
                    );

                    $this->redirect($this->createUrl('/admin/rss'));
                } else {
                    Yii::app()->user->setFlash('error', 'Ошибка при добалении сайта');

                    $transaction->rollback();
                }
            } catch (Exception $e) {
                echo '<pre>';
                print_r($e->getMessage());
                echo '</pre>';
                Yii::app()->user->setFlash('error', 'Ошибка на сервере при добалении сайта. Попробуйте позже.');

                $transaction->rollback();
            }
        }

        $this->render(
            'form',
            [
                'rssSitesModel' => $rssSitesModel,
            ]
        );
    }
}