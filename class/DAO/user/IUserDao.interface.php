<?php
/**
 * Created by PhpStorm.
 * client: Unknown
 * Date: 19/06/2017
 * Time: 23:49
 */

namespace gestionStock\DAO\user;


use gestionStock\entities\user\user;

interface IUserDao
{
    /**
     * @param User $user
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(User $user);

    /**
     * @param User $user
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(User $user);

    /**
     * @param $id int
     * @return User | null
     */
    public function findById($id);

    /**
     * @return multitpe:user
     */
    public function findAll();


}