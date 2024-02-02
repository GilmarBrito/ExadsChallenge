<?php

namespace ExadsChallenge\Core;

use ExadsChallenge\Core\Connection;

class Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Connection())->get();
    }

    private function setParameters($stmt, $key, $value)
    {
        $stmt->bindParam($key, $value);
    }

    private function mountQuery($stmt, $parameters)
    {
        foreach ($parameters as $key => $value) {
            $this->setParameters($stmt, $key, $value);
        }
    }

    public function executeQuery(string $query, array $parameters = [])
    {
        $stmt = $this->conn->prepare($query);
        $this->mountQuery($stmt, $parameters);
        $stmt->execute();

        return $stmt;
    }
}
