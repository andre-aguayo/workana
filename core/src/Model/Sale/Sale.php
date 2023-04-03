<?php

namespace Src\Model\Sale;

use Exception;
use Src\Model\BaseModel;

/**
 * Is a child table
 */
enum SaletChild: string
{
    case ProductCategory = 'product_sales';
}

class Sale extends BaseModel
{

    /**
     * Is a table name of a model
     */
    protected string $tableName = 'sales';

    public function __construct(protected array $requiredColumns = ['total_value', 'total_tax'])
    {
        parent::__construct();
    }

    /**
     * Create Sale with product_sales
     * @param array sale params and product_sales params
     */
    public function create(array $params): bool
    {
        try {
            $this->dbConnection->beginTransaction();
            $this->dbResponse = $this->dbConnection->prepare(
                "INSERT INTO {$this->tableName} (total_value, total_tax) VALUES (:total_value, :total_tax);"
            );
            //execute or throw exception
            $this->dbResponse->execute([
                "total_value" => $params['total_value'],
                "total_tax" => $params['total_tax']
            ]) ?? throw new Exception('Error creating sale.', 400);

            //Create ProductSale
            (new ProductSale)->createMany(
                $params['product_sales'],
                $this->dbConnection->lastInsertId()
            );

            $this->dbConnection->commit();
        } catch (Exception $e) {
            $this->dbConnection->rollBack();
            var_dump($this->dbResponse->errorInfo());
            throw new Exception($e->getMessage(), 400);
        }

        return true;
    }
}
