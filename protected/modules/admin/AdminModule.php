<?php

/**
 * Class AdminModule
 */
class AdminModule extends CWebModule
{

    /**
     *
     */
    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport([
            'admin.models.*',
            'admin.components.*',
        ]);

//        Yii::app()->setComponents(array(
//			'bootstrap' => array('class' => 'ext.bootstrap.components.Bootstrap'),
//        ));
    }

    /**
     * @param CController $controller
     * @param CAction $action
     * @return bool
     */
    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action))
        {
            $controller->layout = 'main';

//            if (!Yii::app()->user->checkAccess('admin')) {
//                Yii::app()->request->redirect('/admin/default/login');
//
//                return false;
//            }

            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else return false;
    }

}