<?php
/**
 * Created by PhpStorm.
 * fournisseur: Unknown
 * Date: 19/06/2017
 * Time: 23:49
 */

namespace gestionStock\DAO\Fournisseur;


use gestionStock\entities\Fournisseur\Fournisseur;

interface IFournisseurDao
{
    /**
     * @param Fournisseur $fournisseur
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Fournisseur $fournisseur);

    /**
     * @param Fournisseur $fournisseur
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Fournisseur $fournisseur);

    /**
     * @param $id int
     * @return Fournisseur | null
     */
    public function findById($id);

    /**
     * @return multitpe:fournisseur
     */
    public function findAll();


}