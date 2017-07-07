<?php
/**
 * Created by PhpStorm.
 * Stock: Unknown
 * Date: 19/06/2017
 * Time: 22:50
 */

namespace gestionStock\DAO\stock;


use gestionStock\entities\stock\stock;

class MysqlStockDao implements IStockDao
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
     * @param stock $stock
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Stock $stock)
    {
        if($stock->getId() === null)
            $this->insert($stock);
        else
            $this->update($stock);

    }

    /**gueuning
     * @param Stock $stock
     * @return void
     * @throws \PDOException
     */
    private function insert(Stock $stock)
    {

        $sql = "INSERT INTO gueuning.stock (id, numPiece, nomPiece, prixAchat, prixVente, emplacement) 
                  VALUES (null, :numPiece, :nomPiece, :prixAchat, :prixVente,:emplacement);";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':numPiece', $stock->getNumPiece(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':nomPiece', $stock->getNomPiece(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':prixAchat', $stock->getPrixAchat(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':prixVente', $stock->getPrixVente(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':emplacement', $stock->getEmplacement(), \PDO::PARAM_STR);

        $preparedStatement->execute();

        $lastId = $this->pdo->lastInsertId();
        $stock->setId($lastId);


    }
    /**
     * @param Stock $stock
     * @return void
     * @throws \PDOException
     */
    private function update(Stock $stock)
    {

        $sql = "UPDATE gueuning.stock SET numPiece = :numPiece, nomPiece = :nomPiece, prixAchat = :prixAchat, prixVente = :prixVente, emplacement = :emplacement WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':numPiece', $stock->getNumPiece(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':nomPiece', $stock->getNomPiece(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':prixAchat', $stock->getPrixAchat(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':prixVente', $stock->getPrixVente(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':emplacement', $stock->getEmplacement(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':id', $stock->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

    }



    /**
     * @param Stock $stock
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Stock $stock)
    {
        if($stock->getId() === null)
            throw new \LogicException("L'id ne peut être null");

        $sql = "DELETE FROM gueuning.stock  WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);

        $preparedStatement->bindValue(':id', $stock->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

        $stock->setId(null);

    }

    /**
     * @param $id int
     * @return Stock | null
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM gueuning.stock  WHERE id = :id LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id', $id, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeStockFromRow($row);


    }

    /**
     * @return multitpe:Stock
     */
    public function findAll()
    {
        $sql = "SELECT * FROM gueuning.stock ORDER BY numPiece ASC";
        $statement = $this->pdo->query($sql);

        $stockList = [];
        while(false !== ($row = $statement->fetch(\PDO::FETCH_ASSOC)))
        {

            $stockList[] =  $this->makeStockFromRow($row);
        }

        return $stockList;
    }


    private function makeStockFromRow(array $row)
    {
        $stock = new Stock();
        $stock->setId($row['id']);
        $stock->setNumPiece($row['numPiece']);
        $stock->setNomPiece($row['nomPiece']);
        $stock->setPrixAchat($row['prixAchat']);
        $stock->setPrixVente($row['prixVente']);
        $stock->setEmplacement($row['emplacement']);

        return $stock;

    }



}