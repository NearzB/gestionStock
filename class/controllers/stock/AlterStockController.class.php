<?php
namespace gestionStock\controllers\stock;

use gestionStock\entities\Stock\stock;

abstract class AlterstockController implements IController
{

    protected $idsFournisseur;
    protected $fournisseurDao;
    protected final function validPostedDataAndSet(Stock $stock)
    {
        $stock->setId(isset($_POST['id'])?(int)$_POST['id']:"");

        $invalidFields = array();


        $stock->setNumPiece(isset($_POST['numPiece']) ? trim($_POST['numPiece']) : "");
        if($stock->getNumPiece() == "")
        {
            $invalidFields[] = 'numPiece';
        }

        $stock->setNomPiece(isset($_POST['nomPiece']) ? trim($_POST['nomPiece']) : "");
        if($stock->getNomPiece() == "" )
        {
            $invalidFields[] = 'nomPiece';
        }


        $stock->setPrixAchat(isset($_POST['prixAchat']) ? trim($_POST['prixAchat']) : "");
        if($stock->getPrixAchat() == "")
        {
            $invalidFields[] = 'prixAchat';
        }


        $stock->setPrixVente(isset($_POST['prixVente']) ? trim($_POST['prixVente']) : "");
        if($stock->getPrixVente() == "")
        {
            $invalidFields[] = 'prixVente';
        }
        
        if(isset($_POST['id_fournisseur']) && in_array($_POST['id_fournisseur'],$this->idsFournisseur)){
            $stock->setFournisseur($this->fournisseurDao->findById((int)$_POST['id_fournisseur']));
        }
        else{
            $invalidFields[]='id_fournisseur';
        }

        $stock->setEmplacement(isset($_POST['emplacement']) ? trim($_POST['emplacement']) : "");
        if($stock->getEmplacement() == "")
        {
            $invalidFields[] = 'emplacement';
        }

        return $invalidFields;


    }


}