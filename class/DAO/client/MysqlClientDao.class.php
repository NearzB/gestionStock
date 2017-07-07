<?php
/**
 * Created by PhpStorm.
 * Client: Unknown
 * Date: 19/06/2017
 * Time: 22:50
 */

namespace gestionStock\DAO\Client;


use gestionStock\entities\client\client;

class MysqlClientDao implements IClientDao
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
     * @param client $client
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Client $client)
    {
        if($client->getId() === null)
            $this->insert($client);
        else
            $this->update($client);

    }

    /**gueuning
     * @param Client $client
     * @return void
     * @throws \PDOException
     */
    private function insert(Client $client)
    {

        $sql = "INSERT INTO gueuning.client (id, nomClient, adresseMailClient, numeroCompte, numeroTva, numeroTel, adresseClient) 
                  VALUES (null, :nomClient, :adresseMailClient, :numeroCompte, :numeroTva, :numeroTel, :adresseClient);";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':nomClient', $client->getNomClient(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':adresseMailClient', $client->getAdresseMailClient(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numeroCompte', $client->getNumeroCompte(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numeroTva', $client->getNumeroTva(), \PDO::PARAM_STR); 
        $preparedStatement->bindValue(':numeroTel', $client->getNumeroTel(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':adresseClient', $client->getadresseClient(), \PDO::PARAM_STR);

        $preparedStatement->execute();

        $lastId = $this->pdo->lastInsertId();
        $client->setId($lastId);


    }
    /**
     * @param Client $client
     * @return void
     * @throws \PDOException
     */
    private function update(Client $client)
    {

        $sql = "UPDATE gueuning.client SET nomClient = :nomClient, adresseMailClient = :adresseMailClient, numeroCompte = :numeroCompte, numeroTva = :numeroTva, numeroTel = :numeroTel, adresseClient = :adresseClient WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':nomClient', $client->getNomClient(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':adresseMailClient', $client->getAdresseMailClient(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numeroCompte', $client->getNumeroCompte(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numeroTva', $client->getNumeroTva(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numeroTel', $client->getNumeroTel(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':adresseClient', $client->getadresseClient(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':id', $client->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

    }



    /**
     * @param Client $client
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Client $client)
    {
        if($client->getId() === null)
            throw new \LogicException("id can't be null");

        $sql = "DELETE FROM gueuning.client  WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);

        $preparedStatement->bindValue(':id', $client->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

        $client->setId(null);

    }

    /**
     * @param $id int
     * @return Client | null
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM gueuning.client  WHERE id = :id LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id', $id, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeClientFromRow($row);


    }

    /**
     * @return multitpe:Client
     */
    public function findAll()
    {
        $sql = "SELECT * FROM gueuning.client ORDER BY nomClient ASC";
        $statement = $this->pdo->query($sql);

        $clientList = [];
        while(false !== ($row = $statement->fetch(\PDO::FETCH_ASSOC)))
        {

            $clientList[] =  $this->makeClientFromRow($row);
        }

        return $clientList;
    }

    public function findByAdresseMailClient($adresseMailClient)
    {
        $sql = "SELECT * FROM gueuning.client  WHERE adresseMailClient = :adresseMailClient LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':adresseMailClient', $adresseMailClient, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeClientFromRow($row);
    }

    private function makeClientFromRow(array $row)
    {
        $client = new Client();
        $client->setId($row['id']);
        $client->setNomClient($row['nomClient']);
        $client->setAdresseMailClient($row['adresseMailClient']);
        $client->setNumeroCompte($row['numeroCompte']);
        $client->setNumeroTva($row['numeroTva']);
        $client->setNumeroTel($row['numeroTel']);
        $client->setAdresseClient($row['adresseClient']);

     return $client;

    }



}