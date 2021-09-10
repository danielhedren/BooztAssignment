<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection;
use PDO;

abstract class Repository
{
    private string $className;
    private string $tableName;

    public function __construct(string $className, string $tableName)
    {
        $this->className = $className;
        $this->tableName = $tableName;
    }

    public function find(int $id)
    {
        $conn = Connection::Open();
        // String interpolation in queries like this has to be done with care. We control this fully.
        $stmt = $conn->prepare("SELECT * FROM `{$this->tableName}` WHERE id = :id");
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->className);
        $stmt->execute([
            ':id' => $id
        ]);

        $entity = $stmt->fetch();

        if ($entity === false) {
            return null;
        }
        
        return $entity;
    }

    public function findAll()
    {
        $conn = Connection::Open();
        $stmt = $conn->prepare("SELECT * FROM `{$this->tableName}`");
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->className);
        $stmt->execute();

        $entities = $stmt->fetchAll();

        if ($entities === false) {
            return [];
        }

        return $entities;
    }

    public function getCount(): int
    {
        $conn = Connection::Open();
        $stmt = $conn->query("SELECT COUNT(*) FROM `{$this->tableName}`");

        return intval($stmt->fetchColumn());
    }
}