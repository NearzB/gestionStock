<?php
/**
 * Created by PhpStorm.
 * Fournisseur: Unknown
 * Date: 20/06/2017
 * Time: 15:04
 */

namespace gestionStock\controllers\fournisseur;

use gestionStock\DAO\fournisseur\MysqlFournisseurDao;
use gestionStock\exceptions\fournisseur\InvalidActionException;
use gestionStock\exceptions\fournisseur\InvalidDataException;
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
            $clientDao = new MysqlFournisseurDao($pdo);


            $fournisseur = $clientDao->findById($id);

            if ($fournisseur === null)
                throw new InvalidActionException("Impossible de retouver l'id du fournisseur" . $id);

            $data['fournisseur'] = $fournisseur;

            if (!isset($_POST['id']))
            {
                $view = new EditFournisseurView();
                $view->showView($data);
                return;
            }


            //On a soumis le formulaire
            $invalidFields = $this->validPostedDataAndSet($fournisseur);


            if (count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);


                $isTransactioStarted = $pdo->beginTransaction();
                $clientDao->insertOrUpdate($fournisseur);
                $pdo->commit();


                header("Location: " . $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"]);


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
                $data['invalidFields'] = array("email");
            } else
                $data['error'] = $ex->getMessage();

            if ($ex instanceof InvalidDataException)
                $data['invalidFields'] = $ex->getInvalidData();

            if ($isTransactioStarted)
                $pdo->rollBack();


            $view = new EditFournisseurView();
            $view->showView($data);


        }
    }
}
