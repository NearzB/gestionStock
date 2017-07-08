<?php
/**
 * Created by PhpStorm.
 * Stock: Unknown
 * Date: 20/06/2017
 * Time: 15:04
 */

namespace gestionStock\controllers\stock;

use gestionStock\DAO\stock\MysqlStockDao;
use gestionStock\DAO\fournisseur\MysqlFournisseurDao;
use gestionStock\entities\fournisseur\Fournisseur;
use gestionStock\exceptions\InvalidActionException;
use gestionStock\exceptions\InvalidDataException;
use gestionStock\utils\ErrorMessageManager;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\stock\EditStockView;
use gestionStock\views\stock\HomeView;


class EditStockController extends AlterStockController implements IController
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
            $stockDao = new MysqlStockDao($pdo);


            $stock = $stockDao->findById($id);

            if ($stock === null)
                throw new InvalidActionException("Impossible de retrouver l'id du stock ");

            $data['stock'] = $stock;
            
            $fournisseurDao=new MysqlFournisseurDao($pdo);
            $data['fournisseurs']=$fournisseurDao->findAll();

            $view = new EditStockView();
            $view->showView($data);


        }
        catch (\Exception $ex)
        {
            if ($ex instanceof InvalidActionException) {
                ErrorMessageManager::getInstance()->addMessage($ex->getMessage());
                header("Location: index.php?action=home&entities=stock");
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
