<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 14/06/2017
 * Time: 19:40
 */

namespace gestionStock\entities\fournisseur;


class Fournisseur
{

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nomFournisseur;
    /**
     * @var string
     */
    private $numeroCompte;
    /**
     * @var int
     */
    private $numeroTel;
    /**
     * @var string
     */
    private $numeroTVA;
    /**
     * @var string
     */
    private $adresse;
    /**
     * @var string
     */
    private $email;











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
    public function getNomFournisseur()
    {
        return $this->nomFournisseur;
    }

    /**
     * @param string $nomFournisseur
     */
    public function setNomFournissseur($nomFournisseur)
    {
        $this->nomFournisseur = $nomFournisseur;
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
    public function getNumeroTVA()
    {
        return $this->numeroTVA;
    }

    /**
     * @param string $numeroTVA
     */
    public function setNumeroTVA($numeroTVA)
    {
        $this->numeroTVA = $numeroTVA;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresseClient = $adresse;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}