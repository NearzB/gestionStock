<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 28/06/2017
 * Time: 20:20
 */

namespace gestionStock\controllers\stock;

use gestionStock\DAO\stock\MysqlStockDao;
use gestionStock\entities\stock\stock;
use gestionStock\exceptions\stock\InvalidDataException;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\stock\CreateStockView;
use gestionStock\views\stock\HomeView;


class CreateStockController extends AlterStockController implements IController
{
    public function doAction()
    {
        $stock = new stock();
        $data['stock'] = $stock;
        $data['stockList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        $data = array();
        try
        {

            if(!isset($_POST['id']))
            {
                $view = new CreateStockView();
                $view->showView($data);
                return;
            }
            $invalidFields = $this->validPostedDataAndSet($stock);

            if(count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);

            $pdo = MysqlConnection::getConnection();
            $stockDao = new MysqlstockDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $stockDao->insertOrUpdate($stock);
            $pdo->commit();
           // header("Location: index.php");



        }
        catch (\Exception $ex)
        {
            if($ex instanceof InvalidDataException)
                $data['invalidFields'] = $ex->getInvalidData();

            if($isTransactioStarted)
                $pdo->rollBack();

            $view = new CreateStockView();
            $view->showView($data);

        }

    }
}