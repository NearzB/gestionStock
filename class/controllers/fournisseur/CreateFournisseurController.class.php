<?php
namespace gestionStock\controllers\fournisseur;


use gestionStock\DAO\fournisseur\MysqlFournisseurDao;
use gestionStock\entities\fournisseur\Fournisseur;
use gestionStock\exceptions\InvalidDataException;
use gestionStock\utils\MysqlConnection;
use gestionStock\views\fournisseur\CreateFournisseurView;
use gestionStock\views\fournisseur\EditFournisseurView;
use gestionStock\views\fournisseur\HomeView;

class CreateFournisseurController extends AlterFournisseurController implements IController
{
    public function doAction()
    {


        $fournisseur = new Fournisseur();
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

            $action=($fournisseur->getId()=="")?'ajouté':'modifié';
            
            $pdo = MysqlConnection::getConnection();
            $fournisseurDao = new MysqlFournisseurDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();
            $fournisseurDao->insertOrUpdate($fournisseur);
            $pdo->commit();
            $_SESSION['success']="Fournisseur correctement $action";
            header("Location: index.php?action=home&entities=fournisseur");

        }
        catch (\Exception $ex)
        {
            if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $rows=['nomFournisseur','numeroCompte','numeroTel','numeroTVA','adresse','email'];
                $names=['Le nom du fournisseur','Le numéro de compte','Le numéro de téléphone','Le numéro de TVA','L\'adresse','L\'adresse email'];
                $_SESSION['error']="Ce fournisseur existe déjà";
                $row="";
                for($i=0;$i<sizeof($rows);$i++){
                    $row=$rows[$i];
                    if(stripos($ex->errorInfo[2],"pour la clef '$row'")!==false){
                        $_SESSION['error']=$names[$i]." existe déjà.";
                        break;
                    }
                }
                $data['invalidFields'] = array($row);
            }
            else
                $_SESSION['error'] = $ex->getMessage();

            if($ex instanceof InvalidDataException)
                $data['invalidFields'] = $ex->getInvalidData();

            if($isTransactioStarted)
                $pdo->rollBack();

            $data['fournisseur'] = $fournisseur;
            if(!isset($_POST['id'])){
                $view = new CreateFournisseurView();
            }else{
                $view = new EditFournisseurView();
            }
            
            $view->showView($data);

        }







    }
}