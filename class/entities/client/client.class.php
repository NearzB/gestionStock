<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 14/06/2017
 * Time: 20:03
 */

namespace gestionStock\entities\client;


class Client
{

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nomClient;
    /**
     * @var string
     */
    private $adresseMailClient;
    /**
     * @var string
     */
    private $numeroCompte;
    /**
     * @var string
     */
    private $numeroTva;
    /**
     * @var int
     */
    private $numeroTel;
    /**
     * @var string
     */
    private $adresseClient;






    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = (int)$id;
        if($this->id === 0)
            $this->id = null;
    }



    /**
     * @return string
     */
    public function getNomClient()
    {
        return $this->nomClient;
    }

    /**
     * @param string $nomClient
     */
    public function setNomClient($nomClient)
    {
        $this->nomClient = $nomClient;
    }


    /**
     * @return string
     */
    public function getAdresseMailClient()
    {
        return $this->adresseMailClient;
    }

    /**
     * @param string $adresseMailClient
     */
    public function setAdresseMailClient($adresseMailClient)
    {
        $this->adresseMailClient = $adresseMailClient;
    }




    /**
     * @return string
     */
    public function getNumeroCompte()
    {
        return $this->numeroCompte;
    }

    /**
     * @param string $numeroCompte
     */
    public function setNumeroCompte($numeroCompte)
    {
        $this->numeroCompte = $numeroCompte;
    }




    /**
 * @return string
 */
    public function getNumeroTva()
    {
        return $this->numeroTva;
    }

    /**
     * @param string $numeroTva
     */
    public function setNumeroTva($numeroTva)
    {
        $this->numeroTva = $numeroTva;
    }




    /**
     * @return int
     */
    public function getNumeroTel()
    {
        return $this->numeroTel;
    }

    /**
     * @param int $numeroTel
     */
    public function setNumeroTel($numeroTel)
    {
        $this->numeroTel = $numeroTel;
    }

    /**
     * @return string
     */
    public function getAdresseClient()
    {
        return $this->adresseClient;
    }

    /**
     * @param string $adresseClient
     */
    public function setAdresseClient($adresseClient)
    {
        $this->adresseClient = $adresseClient;
    }
}