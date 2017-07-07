<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 14/06/2017
 * Time: 18:32
 */

namespace gestionStock\entities\stock;


class stock
{

    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $numPiece;
    /**
     * @var string
     */

    private $nomPiece;
    /**
     * @var string date
     */
    private $dateReception;

    /**
     * @var double
    */

    private $prixAchat;

    /**
     * @var double
     */
    private $prixVente;
    /**
     * @var string
     */
    private $emplacement;


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
        if ($this->id === 0)
            $this->id = null;
    }


    /**
     * @return int
     */
    public function getNumPiece()
    {
        return $this->numPiece;
    }

    /**
     * @param int $numPiece
     */
    public function setNumPiece($numPiece)
    {
        $this->numPiece = $numPiece;
    }


    /**
     * @return string
     */
    public function getNomPiece()
    {
        return $this->nomPiece;
    }

    /**
     * @param string $nomPiece
     */
    public function setNomPiece($nomPiece)
    {
        $this->nomPiece = $nomPiece;
    }


    /**
     * @return string
     */
    public function getPrixVente()
    {
        return $this-> prixVente;
    }

    /**
     * @param string $prixVente
     */
    public function setPrixVente($prixVente)
    {
        $this->prixAVente = $prixVente;
    }


    /**
     * @return string
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * @param string $emplacement
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;
    }

    /**
     * @return string
     */
    public function getDateReception()
    {
        return $this->dateReception;
    }

    /**
     * @param string $dateReception
     */
    public function setDateReception($dateReception)
    {
        $this->dateReception = $dateReception;
    }
    /**
     * @return float
     */
    public function getPrixAchat()
    {
        return $this->prixAchat;
    }
    /**
     * @param float $prixAchat
     */
    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;
    }

}