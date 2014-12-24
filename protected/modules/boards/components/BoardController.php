<?php

class BoardController extends Controller
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
                'roles' => ['admin', 'user'],
            ],
            ['deny', // deny all users
                'users' => ['*'],
            ],
        ];
    }
}