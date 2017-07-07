<?php

namespace gestionStock\controllers\fournisseur;


use gestionStock\DAO\fournisseur\MysqlFournisseurDao;
use gestionStock\entities\fournisseur\Fournisseur;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\fournisseur\HomeView;

class HomeController implements IController
{

    public function doAction()
    {
        $data = array();
        $data['fournisseur'] = new fournisseur();
        $data['fournisseurList']  = array();

        try
        {
            $pdo = MysqlConnection::getConnection();
            $fournisseurDao = new MysqlFournisseurDao($pdo);
            $data['fournisseurList'] = $fournisseurDao->findAll();
        }
        catch (\Exception $ex)
        {
            $data['error'] = "Service indisponible";
        }
        $view = new HomeView();
        $view->showView($data);

    }

}