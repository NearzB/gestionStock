<?php
/**
 * Created by PhpStorm.
 * Client: Unknown
 * Date: 20/06/2017
 * Time: 15:04
 */

namespace gestionStock\controllers\client;

use gestionStock\DAO\client\MysqlClientDao;
use gestionStock\exceptions\client\InvalidActionException;
use gestionStock\exceptions\client\InvalidDataException;
use gestionStock\utils\ErrorMessageManager;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\client\EditClientView;
use gestionStock\views\client\HomeView;


class EditClientController extends AlterClientController implements IController
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
            $clientDao = new MysqlClientDao($pdo);


            $client = $clientDao->findById($id);

            if ($client === null)
                throw new InvalidActionException("Impossible de retouver l'id du client" . $id);

            $data['client'] = $client;

            if (!isset($_POST['id']))
            {
                $view = new EditClientView();
                $view->showView($data);
                return;
            }


            //On a soumis le formulaire
            $invalidFields = $this->validPostedDataAndSet($client);


            if (count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);


                $isTransactioStarted = $pdo->beginTransaction();
                $clientDao->insertOrUpdate($client);
                $pdo->commit();


                //header("Location: " . $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"]);


        }
        catch (\Exception $ex)
        {
            if ($ex instanceof InvalidActionException) {
                ErrorMessageManager::getInstance()->addMessage($ex->getMessage());
                header("Location: index.php");
                return;
            }

            if ($ex instanceof \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "The email already exists";
                $data['invalidFields'] = array("adresseMailClient");
            } else
                $data['error'] = $ex->getMessage();

            if ($ex instanceof InvalidDataException)
                $data['invalidFields'] = $ex->getInvalidData();

            if ($isTransactioStarted)
                $pdo->rollBack();


            $view = new EditClientView();
            $view->showView($data);


        }
    }
}
