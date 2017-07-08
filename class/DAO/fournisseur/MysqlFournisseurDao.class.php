<?php
/**
 * Created by PhpStorm.
 * Fournisseur: Unknown
 * Date: 19/06/2017
 * Time: 22:50
 */
namespace gestionStock\DAO\fournisseur;

use gestionStock\entities\fournisseur\fournisseur;


class MysqlFournisseurDao implements IFournisseurDao
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
     * @param fournisseur $fournisseur
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Fournisseur $fournisseur)
    {
        if($fournisseur->getId() === null)
            $this->insert($fournisseur);
        else
            $this->update($fournisseur);

    }

    /**
     * @param Fournisseur $fournisseur
     * @return void
     * @throws \PDOException
     */
    private function insert(Fournisseur $fournisseur)
    {

        $sql = "INSERT INTO gestionstock.fournisseurs (id, nomFournisseur, numeroCompte, numeroTel, numeroTva, adresse, email) 
                  VALUES (null, :nomFournisseur, :numeroCompte, :numeroTel, :numeroTva, :adresse, :email);";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':nomFournisseur', $fournisseur->getNomFournisseur(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numeroCompte', $fournisseur->getNumeroCompte(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numeroTel', $fournisseur->getNumeroTel(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numeroTva', $fournisseur->getNumeroTva(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':adresse', $fournisseur->getAdresse(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $fournisseur->getEmail(), \PDO::PARAM_STR);

        $preparedStatement->execute();

        $lastId = $this->pdo->lastInsertId();
        $fournisseur->setId($lastId);


    }
    /**
     * @param Fournisseur $fournisseur
     * @return void
     * @throws \PDOException
     */
    private function update(Fournisseur $fournisseur)
    {

        $sql = "UPDATE gestionstock.fournisseurs SET nomFournisseur = :nomFournisseur, numeroCompte = :numeroCompte, numeroTel = :numeroTel, numeroTva = :numeroTva, adresse = :adresse, email = :email WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':nomFournisseur', $fournisseur->getNomFournisseur(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numeroCompte', $fournisseur->getNumeroCompte(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numeroTel', $fournisseur->getNumeroTel(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numeroTva', $fournisseur->getNumeroTva(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':adresse', $fournisseur->getAdresse(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $fournisseur->getEmail(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':id', $fournisseur->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

    }



    /**
     * @param Fournisseur $fournisseur
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Fournisseur $fournisseur)
    {
        if($fournisseur->getId() === null)
            throw new \LogicException("id can't be null");

        $sql = "DELETE FROM gestionstock.fournisseurs  WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);

        $preparedStatement->bindValue(':id', $fournisseur->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

        $fournisseur->setId(null);

    }

    /**
     * @param $id int
     * @return Fournisseur | null
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM gestionstock.fournisseurs  WHERE id = :id LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id', $id, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeFournisseurFromRow($row);


    }

    /**
     * @return multitpe:Fournisseur
     */
    public function findAll()
    {
        $sql = "SELECT * FROM gestionstock.fournisseurs ORDER BY nomFournisseur ASC";
        $statement = $this->pdo->query($sql);

        $fournisseurList = [];
        while(false !== ($row = $statement->fetch(\PDO::FETCH_ASSOC)))
        {

            $fournisseurList[] =  $this->makefournisseurFromRow($row);
        }

        return $fournisseurList;
    }
    /**
     * @return array
     */
    public function getIds()
    {
        $sql="SELECT id FROM gestionstock.fournisseurs ORDER BY id";
        $statement=$this->pdo->query($sql);
        $idList=[];
        while(false!==($row=$statement->fetch(\PDO::FETCH_ASSOC)))
        {
            $idList[]=$row['id'];
        }
        return $idList;
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM gestionstock.fournisseurs  WHERE email = :email LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':email', $email, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeFournisseurFromRow($row);
    }

    private function makeFournisseurFromRow(array $row)
    {
        $fournisseur = new Fournisseur();
        $fournisseur->setId($row['id']);
        $fournisseur->setNomFournissseur($row['nomFournisseur']);
        $fournisseur->setNumeroCompte($row['numeroCompte']);
        $fournisseur->setNumeroTel($row['numeroTel']);
        $fournisseur->setNumeroTva($row['numeroTVA']);
        $fournisseur->setAdresse($row['adresse']);
        $fournisseur->setEmail($row['email']);

        return $fournisseur;

    }
}