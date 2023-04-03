<?php

namespace Src\Config;

use PDO;
use PDOException;

class Database
{
    private array $databaseConfig = [
        "driver" => "mysql",
        "host" => "mysql",
        "port" => 3306,
        "database" => "iurru",
        "username" => "iurru",
        "password" => "5533",
        "options" => [
            PDO::MYSQL_ATTR_INIT_COMMAND    => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_CASE => PDO::CASE_NATURAL,
            PDO::ATTR_EMULATE_PREPARES, false
        ]
    ];

    /**
     * Is a pdo connection
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->connect();
    }

    /**
     * @return PDO conneciton
     */
    public function getConnection()
    {
        return $this->pdo;
    }

    private function connect()
    {
        $dsn = $this->databaseConfig['driver'] .
            ":host=" .
            $this->databaseConfig['host'] .
            ";dbname=" .
            $this->databaseConfig['database'] .
            ";charset=UTF8";

        try {
            $pdo = new PDO(
                $dsn,
                $this->databaseConfig['username'],
                $this->databaseConfig['password'],
                $this->databaseConfig['options']
            );

            if (!$pdo)
                throw new PDOException('Connection to database failed.', 500);

            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
