<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 01/07/2017
 * Time: 16:59
 */

namespace gestionUser\controllers\user;

use gestionStock\controllers\IController;
use gestionStock\DAO\user\MysqlUserDao;
use gestionStock\exceptions\user\InvalidActionException;
use gestionStock\utils\ErrorMessageManager;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\user\HomeView;
use gestionStock\views\user\ConfirmUserDeletionView;

class DeleteUserController implements IController
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
            $userDao = new MysqlUserDao($pdo);


            $user = $userDao->findById($id);

            if ($user === null)
                throw new InvalidActionException("Impossible de retrouver la pièce avec son id... " . $id);


            if (!isset($_POST['confirmed'])) {
                $view = new ConfirmUserDeletionView();
                $view->showView(array('stock' => $user));
                //return;
            }


            $userDao->delete($user);
            ErrorMessageManager::getInstance()->addMessage("Pièce supprimée avec succes !");
            header("Location: index.php");


        } catch (\Exception $ex) {
            $data['error'] = $ex->getMessage();


            if ($isTransactioStarted)
                $pdo->rollBack();

            ErrorMessageManager::getInstance()->addMessage($ex->getMessage());
            header("Location: index.php");
            return;

        }
    }
}



