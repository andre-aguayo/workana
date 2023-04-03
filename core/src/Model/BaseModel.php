<?php

namespace Src\Model;

use Exception;
use Src\Config\Database;
use Src\Services\PluralizeWord;
use PDO;

abstract class BaseModel
{
    /**
     * Child table name
     */
    private string $tableName;

    /**
     * Are the columns that do not have default values
     */
    protected array $requiredColumns;

    /**
     * Are the columns that have default values
     * it was not used because it will not be possible under these conditions
     */
    protected array $optionaldColumns;

    /**
     * Is a model parent name
     */
    protected string $parentName;

    /**
     * Is a db connection
     */
    protected $dbConnection;

    /**
     * Is a db response
     */
    protected $dbResponse;

    public function __construct()
    {
        $this->dbConnection = (new Database)->getConnection();
        $this->tableName = (new PluralizeWord)->pluralize(get_called_class());
    }

    /**
     * Get all corresponding table
     */
    public function getAll(?string $tableName, ?int $limit, ?int $offset): array
    {
        if ($tableName === null)
            $tableName = $this->tableName;

        $query = "SELECT * FROM $tableName ";

        $params = [];
        if ($limit > 0) {
            $query .= " LIMIT :limit";
            $params[] = ["limit" => $limit];

            if ($offset > 0) {
                $query .= " OFFSET :offset";
                $params[] = ["offset" => $offset];
            }
        }

        $this->dbResponse = $this->dbConnection->prepare($query . " ORDER BY id DESC");
        $this->dbResponse->execute($params);
        return $this->dbResponse->fetchAll();
    }

    /**
     * Get all corresponding table
     */
    public function findById(int $id): array
    {
        $query = "SELECT * FROM {$this->tableName} WHERE id = :id ORDER BY id DESC";

        $this->dbResponse = $this->dbConnection->prepare($query);
        $this->dbResponse->execute(['id' => $id]);
        return $this->dbResponse->fetch() ?: throw new Exception("Not find product id = $id", 400);
    }

    /**
     * Get child of a parent
     * @param string $parents 
     * @return array of child relationated
     */
    public function getAllWithParent(int $limit = 0, int $offset = 0): array
    {
        $parents = $this->getAll($this->parentName, $limit, $offset);
        $response = [];
        foreach ($parents as $parent) {
            $dbParentResponse = $this->dbConnection->prepare("SELECT * FROM {$this->tableName} ORDER BY id DESC");
            $dbParentResponse->execute();
            $response[] = [...$parent, $this->tableName => $dbParentResponse->fetchAll()];
        }
        return $response;
    }

    /**
     * Insert values into corresponding table
     * 
     * @throws Exception case insert failes
     * @param array values to insert in table
     * @return bool Insert in table?
     */
    public function create(array $values): bool
    {
        $baseQuery = "INSERT INTO {$this->tableName} ("; //firs part of query
        $valuesQuery = ") VALUES ("; //second part of query "VALUES"
        $params = []; // Params to insert into execute()
        $coma = ''; //Is the comma between the columns and values

        //generate query and params
        foreach ($this->requiredColumns as $column) {
            $baseQuery .= " $coma`$column` ";
            $valuesQuery .= " $coma :$column ";
            $coma = ','; //to insert into query

            $params[] = $values[$column];
        }

        $this->dbResponse = $this->dbConnection->prepare($baseQuery . $valuesQuery . ");");
        return $this->dbResponse->execute($params) ?? throw new Exception("Error creating {$this->tableName}.", 400);
    }

    public function beginTransaction(): bool
    {
        return $this->dbConnection->beginTransaction();
    }

    public function commit(): bool
    {
        return  $this->dbConnection->commit();
    }

    public function rollBack(): bool
    {
        return $this->dbConnection->rollBack();
    }

    public function getLastInsertId(): int
    {
        return $this->dbConnection->lastInsertId();
    }

    public function __destruct()
    {
        $this->dbConnection = null;
    }
}
