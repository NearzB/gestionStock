<?php
/**
 * Created by PhpStorm.
 * Fournisseur: Unknown
 * Date: 20/06/2017
 * Time: 15:04
 */

namespace gestionStock\controllers\fournisseur;

use gestionStock\DAO\fournisseur\MysqlFournisseurDao;
use gestionStock\exceptions\InvalidActionException;
use gestionStock\exceptions\InvalidDataException;
use gestionStock\utils\ErrorMessageManager;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\fournisseur\EditFournisseurView;
use gestionStock\views\fournisseur\HomeView;


class EditFournisseurController extends AlterFournisseurController implements IController
{

    public function doAction()
    {
        $data = array();
        $isTransactioStarted = false;
        $pdo = null;


        try {
            if (!isset($_GET["id"]))
                throw new InvalidActionException("Id manquant");

            $id = (int)$_GET["id"];


            $pdo = MysqlConnection::getConnection();
            $fournisseurDao = new MysqlFournisseurDao($pdo);


            $fournisseur = $fournisseurDao->findById($id);

            if ($fournisseur === null)
                throw new InvalidActionException("Impossible de retrouver l'id du fournisseur ");

            $data['fournisseur'] = $fournisseur;
            

            $view = new EditFournisseurView();
            $view->showView($data);


        }
        catch (\Exception $ex)
        {
            if ($ex instanceof InvalidActionException) {
                ErrorMessageManager::getInstance()->addMessage($ex->getMessage());
                header("Location: index.php?action=home&entities=fournisseur");
                return;
            }

            if ($ex instanceof \PDOException)
            {
                $_SESSION['error'] = "Service indisponible";
            } else
                $_SESSION['error'] = $ex->getMessage();

            if ($isTransactioStarted)
                $pdo->rollBack();


            header("Location: index.php");


        }
    }
}
