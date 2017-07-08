<?php
namespace gestionStock\controllers\fournisseur;

use gestionStock\entities\Fournisseur\fournisseur;

abstract class AlterFournisseurController implements IController
{



    protected final function validPostedDataAndSet(Fournisseur $fournisseur)
    {
        $fournisseur->setId(isset($_POST['id'])?(int)$_POST['id']:"");

        $invalidFields = array();

        $fournisseur->setNomFournissseur(isset($_POST['nomFournisseur']) ? trim($_POST['nomFournisseur']) : "");
        if($fournisseur->getNomFournisseur() == "")
        {
            $invalidFields[] = 'nomFournisseur';
        }

        $fournisseur->setNumeroCompte(isset($_POST['numeroCompte']) ? trim($_POST['numeroCompte']) : "");
        if($fournisseur->getNumeroCompte() == "")
        {
            $invalidFields[] = 'numeroCompte';
        }

        $fournisseur->setNumeroTel(isset($_POST['numeroTel']) ? trim($_POST['numeroTel']) : "");
        if($fournisseur->getNumeroTel() == "")
        {
            $invalidFields[] = 'numeroTel';
        }

        $fournisseur->setNumeroTVA(isset($_POST['numeroTVA']) ? trim($_POST['numeroTVA']) : "");
        if($fournisseur->getNumeroTVA() == "")
        {
            $invalidFields[] = 'numeroTVA';
        }


        $fournisseur->setAdresse(isset($_POST['adresse']) ? trim($_POST['adresse']) : "");
        if($fournisseur->getAdresse() == "")
        {
            $invalidFields[] = 'adresse';
        }

        $fournisseur->setEmail(isset($_POST['email']) ? trim($_POST['email']) : "");
        if($fournisseur->getEmail() == "" || !filter_var($fournisseur->getEmail(), FILTER_VALIDATE_EMAIL))
        {
            $invalidFields[] = 'email';
        }

        return $invalidFields;


    }


}