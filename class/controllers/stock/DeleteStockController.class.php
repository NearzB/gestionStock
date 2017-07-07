<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 28/06/2017
 * Time: 20:25
 */

namespace gestionStock\controllers\stock;

use gestionStock\DAO\stock\MysqlStockDao;
use gestionStock\exceptions\stock\InvalidActionException;
use gestionStock\utils\ErrorMessageManager;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\stock\HomeView;
class DeleteStockController implements IController

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
                throw new InvalidActionException("Impossible de retrouver la pièce avec son id... " . $id);


            if (!isset($_POST['confirmed'])) {
                $view = new ConfirmStockDeletionView();
                $view->showView(array('stock' => $stock));
                //return;
            }


            $stockDao->delete($stock);
            ErrorMessageManager::getInstance()->addMessage("Pièce supprimée avec succes !");
            header("Location: index.php");


        } catch (\Exception $ex) {
            $data['error'] = $ex->getMessage();


            if ($isTransactioStarted)
                $pdo->rollBack();

            ErrorMessageManager::getInstance()->addMessage($ex->getMessage());
            header("Location: index.php");
            return;

        }
    }
}


