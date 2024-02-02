<?php

namespace ExadsChallenge\Models;

use ExadsChallenge\Core\Database;
use ExadsChallenge\Interfaces\ModelInterface;
use PDO;

class BaseModel implements ModelInterface
{
    protected Database $database;
    protected string $tableName;

    public function __construct()
    {
        $this->database = new Database();
    }
    public function findAll()
    {
        $result = $this->database->executeQuery("SELECT * FROM {$this->tableName}");

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id)
    {
        $result = $this->database->executeQuery(
            "SELECT * FROM {$this->tableName} WHERE id = :ID LIMIT 1",
            [
                ':ID' => $id,
            ]
        );

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
