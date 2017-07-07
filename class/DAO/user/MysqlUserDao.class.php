<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 19/06/2017
 * Time: 22:50
 */

namespace gestionStock\DAO\user;


use gestionStock\entities\user\User;

class MysqlUserDao implements IUserDao
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param user $user
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(User $user)
    {
        if($user->getId() === null)
            $this->insert($user);
        else
            $this->update($user);

    }

    /**gueuning
     * @param User $user
     * @return void
     * @throws \PDOException
     */
    private function insert(User $user)
    {

        $sql = "INSERT INTO gueuning.user (id, nom, prenom, identifiant, password, email) 
                  VALUES (null, :nom, :prenom, :identifiant, :password, :email);";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':nom', $user->getNom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':prenom', $user->getPrenom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':identifiant', $user->getIdentifiant(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':password', $user->getpassword(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);

        $preparedStatement->execute();

        $lastId = $this->pdo->lastInsertId();
        $user->setId($lastId);


    }
    /**
     * @param User $user
     * @return void
     * @throws \PDOException
     */
    private function update(User $user)
    {

        $sql = "UPDATE gueuning.user SET nom = :nom, prenom = :prenom, identifiant = :identifiant, password = :password, email = :email WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':nom', $user->getNom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':prenom', $user->getPrenom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':identifiant', $user->getIdentifiant(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':password', $user->getpassword(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':id', $user->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

    }



    /**
     * @param User $user
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(User $user)
    {
        if($user->getId() === null)
            throw new \LogicException("id can't be null");

        $sql = "DELETE FROM gueuning.user  WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);

        $preparedStatement->bindValue(':id', $user->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

        $user->setId(null);

    }

    /**
     * @param $id int
     * @return User | null
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM gueuning.user  WHERE id = :id LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id', $id, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeUserFromRow($row);


    }

    /**
     * @return multitpe:User
     */
    public function findAll()
    {
        $sql = "SELECT * FROM gueuning.user ORDER BY nom ASC";
        $statement = $this->pdo->query($sql);

        $userList = [];
        while(false !== ($row = $statement->fetch(\PDO::FETCH_ASSOC)))
        {

            $userList[] =  $this->makeUserFromRow($row);
        }

        return $userList;
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM gueuning.user  WHERE email = :email LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':email', $email, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeUserFromRow($row);
    }

    private function makeUserFromRow(array $row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setNom($row['nom']);
        $user->setPrenom($row['prenom']);
        $user->setIdentifiant($row['identifiant']);
        $user->setPassword($row['password']);
        $user->setEmail($row['email']);

     return $user;

    }
}