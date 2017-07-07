<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 19/06/2017
 * Time: 21:23
 */

namespace gestionStock\entities\user;


class facturation
{

    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $mainDOeuvre;
    /**
     * @var int
     */
    private $montant;
    /**
     * @var string date
     */
    private $dateFacturation;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = (int)$id;
        if($this->id === 0)
            $this->id = null;

    }
    /**
     * @return int
     */
    public function getMainDOeuvre(): int
    {
        return $this->mainDOeuvre;
    }

    /**
     * @param int $mainDOeuvre
     */
    public function setMainDOeuvre(int $mainDOeuvre)
    {
        $this->mainDOeuvre = $mainDOeuvre;
    }

    /**
     * @return string
     */
    public function getDateFacturation(): string
    {
        return $this->dateFacturation;
    }

    /**
     * @param string $dateFacturation
     */
    public function setDateFacturation(string $dateFacturation)
    {
        $this->dateFacturation = $dateFacturation;
    }

    /**
     * @return int
     */
    public function getMontant(): int
    {
        return $this->montant;
    }

    /**
     * @param int $montant
     */
    public function setMontant(int $montant)
    {
        $this->montant = $montant;
    }






}