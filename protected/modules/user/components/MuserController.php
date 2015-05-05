<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MuserController
 *
 * @author Gennadiy
 */
class MuserController extends Controller
{
    public $menuActive = '';

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
	            'roles' => [Users::ROLE_ADMIN, Users::ROLE_MUSER, Users::ROLE_CHASHKA],
            ],
            ['deny', // deny all users
                'users' => ['*'],
            ],
        ];
    }

}
?>
