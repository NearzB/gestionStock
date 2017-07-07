<?php
/**
 * Created by PhpStorm.
 * stock: Unknown
 * Date: 19/06/2017
 * Time: 23:49
 */

namespace gestionStock\DAO\stock;


use gestionStock\entities\stock\stock;

interface IStockDao
{
    /**
     * @param Stock $stock
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Stock $stock);

    /**
     * @param Stock $stock
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Stock $stock);

    /**
     * @param $id int
     * @return Stock | null
     */
    public function findById($id);

    /**
     * @return multitpe:stock
     */
    public function findAll();


}