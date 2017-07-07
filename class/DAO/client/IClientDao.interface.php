<?php
/**
 * Created by PhpStorm.
 * client: Unknown
 * Date: 19/06/2017
 * Time: 23:49
 */

namespace gestionStock\DAO\client;


use gestionStock\entities\client\client;

interface IClientDao
{
    /**
     * @param Client $client
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Client $client);

    /**
     * @param Client $client
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Client $client);

    /**
     * @param $id int
     * @return Client | null
     */
    public function findById($id);

    /**
     * @return multitpe:client
     */
    public function findAll();


}