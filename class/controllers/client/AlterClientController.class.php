<?php
namespace gestionStock\controllers\client;

use gestionStock\entities\Client\client;

abstract class AlterClientController implements IController
{



    protected final function validPostedDataAndSet(Client $client)
    {
        $client->setId(isset($_POST['id'])?(int)$_POST['id']:"");

        $invalidFields = array();

        $client->setNomClient(isset($_POST['nomClient']) ? trim($_POST['nomClient']) : "");
        if($client->getNomClient() == "")
        {
            $invalidFields[] = 'nomClient';
        }

        $client->setAdresseMailClient(isset($_POST['adresseMailClient']) ? trim($_POST['adresseMailClient']) : "");
        if($client->getAdresseMailClient() == "" && filter_var($client->getAdresseMailClient(), FILTER_VALIDATE_EMAIL))
        {
            $invalidFields[] = 'adresseMailClient';
        }


        $client->setNumeroCompte(isset($_POST['numeroCompte']) ? trim($_POST['numeroCompte']) : "");
        if($client->getNumeroCompte() == "")
        {
            $invalidFields[] = 'numeroCompte';
        }


        $client->setNumeroTva(isset($_POST['numeroTva']) ? trim($_POST['numeroTva']) : "");
        if($client->getNumeroTva() == "")
        {
            $invalidFields[] = 'numeroTva';
        }


        $client->setNumeroTel(isset($_POST['numeroTel']) ? trim($_POST['numeroTel']) : "");
        if($client->getNumeroTel() == "")
        {
            $invalidFields[] = 'numeroTel';
        }

        $client->setAdresseClient(isset($_POST['adresseClient']) ? trim($_POST['adresseClient']) : "");
        if($client->getAdresseMailClient() == "")
        {
            $invalidFields[] = 'adresseClient';
        }


        return $invalidFields;


    }


}