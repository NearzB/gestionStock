<?php
namespace gestionStock\controllers\fournisseur;


use gestionStock\DAO\fournisseur\MysqlFournisseurDao;
use gestionStock\exceptions\fournisseur\InvalidActionException;
use gestionStock\exceptions\fournisseur\InvalidDataException;
use gestionStock\utils\ErrorMessageManager;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\fournisseur\ConfirmFournisseurDeletionView;
use gestionStock\views\fournisseur\EditFournisseurView;
use gestionStock\views\fournisseur\HomeView;


class DeleteFournisseurController implements IController
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
            $fournisseurDao = new MysqlFournisseurDao($pdo);


            $fournisseur = $fournisseurDao->findById($id);

            if($fournisseur === null)
                throw new InvalidActionException("Ipossible de trouver l'id du fournisseur ".$id);

            if(!isset($_POST['confirmed']))
            {
                $view = new ConfirmFournisseurDeletionView();
                $view->showView(array('fournisseur'=> $fournisseur));
                //return;
            }

            $fournisseurDao->delete($fournisseur);
            ErrorMessageManager::getInstance()->addMessage("Fournisseur Supprimé avec succes!");
            header("Location: index.php");


        }

        catch (\Exception $ex)
        {

            if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "The email already exists";
                $data['invalidFields'] = array("email");
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