<?php

namespace gestionStock\controllers\client;


use gestionStock\DAO\client\MysqlClientDao;
use gestionStock\entities\client\Client;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\client\HomeView;

class HomeController implements IController
{

    public function doAction()
    {
        $data = array();
        $data['client'] = new client();
        $data['clientList']  = array();

        try
        {
            $pdo = MysqlConnection::getConnection();
            $clientDao = new MysqlClientDao($pdo);
            $data['clientList'] = $clientDao->findAll();
        }
        catch (\Exception $ex)
        {
            $data['error'] = "Service indisponible";
        }
        $view = new HomeView();
        $view->showView($data);

    }

}