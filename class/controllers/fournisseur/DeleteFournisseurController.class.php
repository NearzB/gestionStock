<?php
namespace gestionStock\controllers\fournisseur;


use gestionStock\DAO\fournisseur\MysqlFournisseurDao;
use gestionStock\exceptions\InvalidActionException;
use gestionStock\exceptions\InvalidDataException;
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
                throw new InvalidActionException("Impossible de trouver l'id du fournisseur ".$id);

            if(!isset($_POST['confirmed']))
            {
                $view = new ConfirmFournisseurDeletionView();
                $view->showView(array('fournisseur'=> $fournisseur));
                return;
            }

            $fournisseurDao->delete($fournisseur);
            $_SESSION['success']="Fournisseur supprimé avec succes!";
            header("Location: index.php?action=home&entities=fournisseur");


        }
        catch (\Exception $ex)
        {

            if($ex instanceof \PDOException && $ex->getCode() == 23000)
            {
                $_SESSION['error'] = "Impossible de supprimer ce fournisseur car il intervient dans une pièce.";
                header("Location: index.php?action=home&entities=fournisseur");
                return;
            }
            else
                $_SESSION['error'] = $ex->getMessage();


            if($isTransactioStarted)
                $pdo->rollBack();

            header("Location: index.php");
            return;



        }


    }
}