<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 28/06/2017
 * Time: 20:25
 */

namespace gestionStock\controllers\stock;

use gestionStock\DAO\stock\MysqlStockDao;
use gestionStock\exceptions\InvalidActionException;
use gestionStock\utils\ErrorMessageManager;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\stock\ConfirmStockDeletionView;
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
                throw new InvalidActionException("Impossible de retrouver la pièce avec son id.");


            if (!isset($_POST['confirmed'])) {
                $view = new ConfirmStockDeletionView();
                $view->showView(array('stock' => $stock));
                return;
            }


            $stockDao->delete($stock);
            $_SESSION['success']="Pièce correctement supprimée";
            header("Location: index.php?action=home&entities=stock");


        } catch (\Exception $ex) {
            $_SESSION['error'] = $ex->getMessage();


            if ($isTransactioStarted)
                $pdo->rollBack();

            header("Location: index.php");
            return;

        }
    }
}


