<?php
namespace app\model;

use app\model\errors\QueryExecutionException;
use app\model\errors\TeapotNotExistException;

use app\entity\TeaPot;


use PDO;
use PDOException;

class TeaPotModel
{
    private PDO $connection;

    public function __construct(string $dbHost, string $dbName, string $dbUser, string $dbPassword)
    {
        $this->connection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * from `teapots`;';

        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex) {
            throw new QueryExecutionException($ex->getMessage());
        }
    }

    public function getById(string $id): TeaPot
    {
        $sql = 'SELECT * from `teapots` WHERE `id` = :id;';

        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex) {
            throw new QueryExecutionException($ex->getMessage());
        }

        if (!empty($result)) {
            return new TeaPot(
                $result['id'], $result['fullname'], $result['description'], $result['cost'], $result['stock_balance']
            );
        }
        else {
            throw new TeapotNotExistException();
        }
    }

    public function getByFullName(string $fullName): TeaPot
    {
        $sql = 'SELECT * from `teapots` WHERE `fullname` = :fullname;';

        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute(['fullname' => $fullName]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex) {
            throw new QueryExecutionException($ex->getMessage());
        }

        if (!empty($result)) {
            return new TeaPot(
                $result['id'], $result['fullname'], $result['description'], $result['cost'], $result['stock_balance']
            );
        }
        else {
            throw new TeapotNotExistException();
        }
    }

    public function create(TeaPot $teaPot)
    {
        try {
            $sql  = 'INSERT INTO `teapots` (`id`, `fullname`, `description`, `cost`, `stock_balance`) 
                    VALUES (:id, :fullname, :description, :cost, :stock_balance);';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                'id'            => $teaPot->getId(),
                'fullname'      => $teaPot->getFullName(),
                'description'   => $teaPot->getDescription(),
                'cost'          => $teaPot->getCost(),
                'stock_balance' => $teaPot->getStockBalance()
            ]);
        }
        catch (PDOException $ex) {
            throw new QueryExecutionException($ex->getMessage());
        }
    }

    public function update(TeaPot $newTeaPot)
    {
        try {
            $sql  = 'UPDATE `teapots` SET 
                    `fullname` = :fullname, 
                    `description` = :description, 
                    `cost` = :cost, 
                    `stock_balance` = :stock_balance
                    WHERE `id` = :id;';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                'id'            => $newTeaPot->getId(),
                'fullname'      => $newTeaPot->getFullName(),
                'description'   => $newTeaPot->getDescription(),
                'cost'          => $newTeaPot->getCost(),
                'stock_balance' => $newTeaPot->getStockBalance()
            ]);
        }
        catch (PDOException $ex) {
            throw new QueryExecutionException($ex->getMessage());
        }
    }

    public function delete(string $id)
    {
        try {
            $sql  = 'DELETE FROM `teapots` WHERE id=:id';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(['id' => $id]);
        }
        catch (PDOException $ex) {
            throw new QueryExecutionException($ex->getMessage());
        }
    }


}