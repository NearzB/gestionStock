<?php


namespace gestionStock\controllers;


use gestionStock\DAO\user\MysqlUserDao;
use gestionStock\entities\user\User;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\HomepageView;

class HomepageController implements IController
{

    public function doAction()
    {
        $data = array();
        $data['user'] = new User();
        $data['userList']  = array();

        try
        {
            $pdo = MysqlConnection::getConnection();
            $userDao = new MysqlUserDao($pdo);
            $data['userList'] = $userDao->findAll();
        }
        catch (\Exception $ex)
        {
            $data['error'] = "Service indisponible";
        }
        $view = new HomepageView();
        $view->showView($data);

    }

}