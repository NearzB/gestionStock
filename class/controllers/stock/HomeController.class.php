<?php

namespace gestionStock\controllers\stock;


use gestionStock\DAO\stock\MysqlStockDao;
use gestionStock\entities\stock\Stock;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\stock\HomeView;

class HomeController implements IController
{

    public function doAction()
    {
        $data = array();
        $data['stock'] = new stock();
        $data['stockList']  = array();

        try
        {
            $pdo = MysqlConnection::getConnection();
            $stockDao = new MysqlStockDao($pdo);
            $data['stockList'] = $stockDao->findAll();
        }
        catch (\Exception $ex)
        {
            $data['error'] = "Service indisponible";
        }
        $view = new HomeView();
        $view->showView($data);

    }

}