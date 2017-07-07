<?php
namespace gestionStock\controllers\fournisseur;


use gestionStock\DAO\fournisseur\MysqlFournisseurDao;
use gestionStock\entities\fournisseur\Fournisseur;
use gestionStock\exceptions\fournisseur\InvalidDataException;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\fournisseur\CreateFournisseurView;
use gestionStock\views\fournisseur\HomeView;

class CreateFournisseurController extends AlterFournisseurController implements IController
{
    public function doAction()
    {


        $fournisseur = new Fournisseur();
        $data['fournisseur'] = $fournisseur;
        $data['fournisseurList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        $data = array();
        try
        {

            if(!isset($_POST['id']))
            {
                $view = new CreateFournisseurView();
                $view->showView($data);
                return;
            }
            $invalidFields = $this->validPostedDataAndSet($fournisseur);

            if(count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);

            $pdo = MysqlConnection::getConnection();
            $fournisseurDao = new MysqlFournisseurDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $fournisseurDao->insertOrUpdate($fournisseur);
            $pdo->commit();
            header("Location: index.php");

        }
        catch (\Exception $ex)
        {
            if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "L'adresse e-mail existe déjà.";
                $data['invalidFields'] = array("email");
            }
            else
                $data['error'] = $ex->getMessage();

            if($ex instanceof InvalidDataException)
                $data['invalidFields'] = $ex->getInvalidData();

            if($isTransactioStarted)
                $pdo->rollBack();


            $view = new CreateFournisseurView();
            $view->showView($data);

        }







    }
}