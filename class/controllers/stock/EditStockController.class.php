<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 28/06/2017
 * Time: 21:11
 */

namespace gestionStock\controllers\stock;

use gestionStock\DAO\stock\MysqlStockDao;
use gestionStock\exceptions\stock\InvalidActionException;
use gestionStock\exceptions\stock\InvalidDataException;
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
                throw new InvalidActionException("Impossible de retrouver la pièce avec son id" . $id);

            $data['stock'] = $stock;

            if (!isset($_POST['id']))
            {
                $view = new EditStockView();
                $view->showView($data);
                return;
            }


            //On a soumis le formulaire
            $invalidFields = $this->validPostedDataAndSet($stock);


            if (count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);

            else
            {
                $isTransactioStarted = $pdo->beginTransaction();
                $stockDao->insertOrUpdate($stock);
                $pdo->commit();

                header("Location: " . $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"]);
            }

        }
        catch (\Exception $ex) {
            if ($ex instanceof InvalidActionException) {
                ErrorMessageManager::getInstance()->addMessage($ex->getMessage());
                header("Location: index.php");
                return;
            }

            if ($ex instanceof InvalidDataException)
                $data['invalidFields'] = $ex->getInvalidData();

            if ($isTransactioStarted)
                $pdo->rollBack();


            $view = new EditStockView();
            $view->showView($data);


        }
    }
}

