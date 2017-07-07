<?php
namespace gestionStock\controllers\client;


use gestionStock\DAO\client\MysqlClientDao;
use gestionStock\exceptions\client\InvalidActionException;
use gestionStock\exceptions\client\InvalidDataException;
use gestionStock\utils\ErrorMessageManager;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\client\ConfirmClientDeletionView;
use gestionStock\views\client\EditClientView;
use gestionStock\views\client\HomeView;


class DeleteClientController implements IController
{

    public function doAction()
    {
        $data = array();
        $isTransactioStarted = false;
        $pdo = null;


        try
        {
            if(!isset($_GET["id"]))
                throw new InvalidActionException("Id manquant");

            $id = (int) $_GET["id"];


            $pdo = MysqlConnection::getConnection();
            $clientDao = new MysqlClientDao($pdo);


            $client = $clientDao->findById($id);

            if($client === null)
                throw new InvalidActionException("Ipossible de trouver l'id du client ".$id);

            if(!isset($_POST['confirmed']))
            {
                $view = new ConfirmClientDeletionView();
                $view->showView(array('client'=> $client));
                //return;
            }

            $clientDao->delete($client);
            ErrorMessageManager::getInstance()->addMessage("Client Supprimé avec succes!");
            header("Location: index.php");


        }

        catch (\Exception $ex)
        {

            if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "The email already exists";
                $data['invalidFields'] = array("adresseMailClient");
            }
            else
                $data['error'] = $ex->getMessage();


            if($isTransactioStarted)
                $pdo->rollBack();

            ErrorMessageManager::getInstance()->addMessage($ex->getMessage());
            header("Location: index.php");
            return;



        }


    }
}