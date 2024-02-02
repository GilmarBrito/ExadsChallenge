<?php

namespace ExadsChallenge\Core;

use Exception;
use PDO;
use PDOException;

class Connection extends PDO
{
    // configuração do banco de dados
    private string $dbName;
    private string $dbEngine;
    private string $dbUserName;
    private string $dbPassword;
    private string $dbHost;
    private string $dbPort;
    private static null|PDO $conn = null;

    public function __construct()
    {
        $this->dbName = filter_input(INPUT_ENV, 'DB_NAME');
        $this->dbEngine = filter_input(INPUT_ENV, 'DB_ENGINE');
        $this->dbUserName = filter_input(INPUT_ENV, 'DB_USERNAME');
        $this->dbPassword = filter_input(INPUT_ENV, 'DB_PASSWORD');
        $this->dbHost = filter_input(INPUT_ENV, 'DB_HOST');
        $this->dbPort = filter_input(INPUT_ENV, 'DB_PORT');
    }

    public function get(): PDO
    {
        if (self::$conn === null) {
            try {
                $dsn = sprintf(
                    "%s:dbname=%s;host=%s;port=%s;user=%s;password=%s",
                    $this->dbEngine,
                    $this->dbName,
                    $this->dbHost,
                    $this->dbPort,
                    $this->dbUserName,
                    $this->dbPassword
                );

                $conn = new PDO($dsn);
                $conn->setAttribute(PDO::ATTR_ERRMODE, $conn::ERRMODE_EXCEPTION);

                self::$conn = $conn;
            } catch (PDOException | Exception $e) {
                echo $e->getMessage();
            }
        }

        return self::$conn;
    }
}
