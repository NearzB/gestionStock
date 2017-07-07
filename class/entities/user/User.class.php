<?php

namespace gestionStock\entities\user;


class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nom;
    /**
     * @var string
     */
    private $prenom;
    /**
     * @var string
     */
    private $indentifiant;
    /**
     * @var string
     */
    private $password;
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

        $this->$id = (int)$id;
        if($this->$id === 0)
            $this->$id = null;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->lastName = $prenom;
    }

    /**
     * @return string
     */
    public function getIdentifiant()
    {
        return $this->indentifiant;
    }

    /**
     * @param string $indentifiant
     */
    public function setIdentifiant($indentifiant)
    {
        $this->indentifiant = $indentifiant;
    }

    /**
     * @return string
     */
    public function getpassword()
    {
        return $this->password;
    }

    /**
     * @param string $lastName
     */
    public function setPassword($password)
    {
        $this->password = $password;
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