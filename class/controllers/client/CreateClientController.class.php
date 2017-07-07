<?php
namespace gestionStock\controllers\client;


use gestionStock\DAO\client\MysqlClientDao;
use gestionStock\entities\client\client;
use gestionStock\exceptions\client\InvalidDataException;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\client\CreateClientView;
use gestionStock\views\client\HomeView;

class CreateClientController extends AlterClientController implements IController
{
    public function doAction()
    {


        $client = new Client();
        $data['client'] = $client;
        $data['clientList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        $data = array();
        try
        {

            if(!isset($_POST['id']))
            {
                $view = new CreateClientView();
                $view->showView($data);
                return;
            }
            $invalidFields = $this->validPostedDataAndSet($client);

            if(count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);

            $pdo = MysqlConnection::getConnection();
            $clientDao = new MysqlClientDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $clientDao->insertOrUpdate($client);
            $pdo->commit();
            //header("Location: index.php");

        }
        catch (\Exception $ex)
        {
            if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "L'adresse e-mail existe déjà.";
                $data['invalidFields'] = array("adresseMailClient");
            }
            else
                $data['error'] = $ex->getMessage();

            if($ex instanceof InvalidDataException)
                $data['invalidFields'] = $ex->getInvalidData();

            if($isTransactioStarted)
                $pdo->rollBack();


            $view = new CreateClientView();
            $view->showView($data);

        }







    }
}