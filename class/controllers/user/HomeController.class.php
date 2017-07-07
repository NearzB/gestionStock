<?php

namespace gestionStock\controllers\user;


use gestionStock\DAO\user\MysqlUserDao;
use gestionStock\entities\User\User;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\user\HomeView;

class HomeController implements IController
{

    public function doAction()
    {
        $data = array();
        $data['user'] = new user();
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
        $view = new HomeView();
        $view->showView($data);

    }

}