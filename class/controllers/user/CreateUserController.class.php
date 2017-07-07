<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 28/06/2017
 * Time: 23:21
 */

namespace gestionStock\controllers\user;


use gestionStock\DAO\user\MysqlUserDao;
use gestionStock\entities\user\user;
use gestionStock\exceptions\user\InvalidDataException;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\user\CreateUserView;
use gestionStock\views\user\HomeView;

class CreateUserController extends AlterUserController implements IController
{
    public function doAction()
    {


        $user = new user();
        $data['user'] = $user;
        $data['userList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        $data = array();
        try
        {

            if(!isset($_POST['id']))
            {
                $view = new CreateUserView();
                $view->showView($data);
                return;
            }
            $invalidFields = $this->validPostedDataAndSet($user);

            if(count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);

            $pdo = MysqlConnection::getConnection();
            $userDao = new MysqlUserDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $userDao->insertOrUpdate($user);
            $pdo->commit();
            header("Location: index.php");



        }
        catch (\Exception $ex)
        {
            if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "L'identifiant existe déjà.";
                $data['invalidFields'] = array("identifiant");
            }
            else
                $data['error'] = $ex->getMessage();

            if($ex instanceof InvalidDataException)
                $data['invalidFields'] = $ex->getInvalidData();

            if($isTransactioStarted)
                $pdo->rollBack();

            $view = new CreateUserView();
            $view->showView($data);

        }



    



}
}