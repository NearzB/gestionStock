<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 28/06/2017
 * Time: 20:20
 */

namespace gestionStock\controllers\stock;

use gestionStock\DAO\stock\MysqlStockDao;
use gestionStock\entities\stock\Stock;
use gestionStock\entities\fournisseur\Fournisseur;
use gestionStock\DAO\fournisseur\MysqlFournisseurDao;
use gestionStock\exceptions\InvalidDataException;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\stock\CreateStockView;
use gestionStock\views\stock\EditStockView;
use gestionStock\views\stock\HomeView;


class CreateStockController extends AlterStockController implements IController
{
    public function doAction()
    {
        $stock = new Stock();
        $data['stockList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        $data = array();
        try
        {
            $pdo = MysqlConnection::getConnection();
            $this->fournisseurDao=new MysqlFournisseurDao($pdo);
            if(!isset($_POST['id']))
            {
                
                $data['fournisseurs']=$this->fournisseurDao->findAll();
                $view = new CreateStockView();
                $view->showView($data);
                return;
            }
            $this->idsFournisseur=$this->fournisseurDao->getIds();
            $invalidFields = $this->validPostedDataAndSet($stock);

            if(count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);

            $action=($stock->getId()=="")?'ajouté':'modifié';
            
            $stockDao = new MysqlStockDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $stockDao->insertOrUpdate($stock);
            $pdo->commit();
            $_SESSION['success']="Stock correctement $action";

            header("Location: index.php?action=home&entities=stock");



        }
        catch (\Exception $ex)
        {
            if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $_SESSION['error']="Cette pièce existe déjà";
                $data['invalidFields'] = array('numPiece');
            }else if($ex instanceof InvalidDataException)
            {
                $data['invalidFields'] = $ex->getInvalidData();
                $_SESSION['error']=$ex->getMessage();
            }else
            {
                $_SESSION['error']=$ex->getMessage();
            }
            if($isTransactioStarted)
                $pdo->rollBack();

            $data['stock'] = $stock;
            $data['fournisseurs']=$this->fournisseurDao->findAll();
            if(!isset($_POST['id'])){
                $view = new CreateStockView();
            }else{
                $view= new EditStockView();
            }
            
            $view->showView($data);

        }

    }
}