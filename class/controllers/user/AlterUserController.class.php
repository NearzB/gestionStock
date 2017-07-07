<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 28/06/2017
 * Time: 23:04
 */

namespace gestionStock\controllers\user;

use gestionStock\entities\user\User;

abstract class AlterUserController implements IController
{

    protected final function validPostedDataAndSet(User $User)
    {
        $User->setId(isset($_POST['id'])?(int)$_POST['id']:"");

        $invalidFields = array();

        $User->setNom(isset($_POST['nom']) ? trim($_POST['nom']) : "");
        if($User->getNom() == "")
        {
            $invalidFields[] = 'nom';
        }

        $User->setPrenom(isset($_POST['prenom']) ? trim($_POST['prenom']) : "");
        if($User->getPrenom() == "")
        {
            $invalidFields[] = 'prenom';
        }


        $User->setIdentifiant(isset($_POST['identifiant']) ? trim($_POST['identifiant']) : "");
        if($User->getIdentifiant() == "")
        {
            $invalidFields[] = 'identifiant';
        }


        $User->setPassword(isset($_POST['password']) ? trim($_POST['password']) : "");
        if($User->getpassword() == "")
        {
            $invalidFields[] = 'password';
        }


        $User->setEmail(isset($_POST['email']) ? trim($_POST['email']) : "");
        if($User->getEmail() == "" && filter_var($User->getEmail(), FILTER_VALIDATE_EMAIL))
        {
            $invalidFields[] = 'email';
        }
        return $invalidFields;


    }



}