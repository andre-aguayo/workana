<?php

namespace Src\Model\Sale;

use Exception;
use Src\Model\BaseModel;

/**
 * Is a parent tables
 */
enum SaletParent: string
{
    case Sale = 'sales';
}

class ProductSale extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->requiredColumns = ['sale_id', 'product_id', 'current_value', 'current_tax'];
        $this->parentName = SaletParent::Sale->value;
    }

    /**
     * Insert many product_sales in database from sale
     * @throws Excepcion
     * @param array $productSales is a sale params
     * @param int $saleId 
     * @return bool created?
     */
    public function createMany(array $productSales, int $saleId): bool
    {
        foreach ($productSales as $productSale) {
            var_dump([...$productSale, 'sale_id' => $saleId]);
            // $this->create([...$productSale, 'sale_id' => $saleId])
            //     ?? throw new Exception('Error creating sale.', 400);
        }
        return true;
    }

    /**
     * Insert values into corresponding table
     * @param array values to insert in table
     * @return bool Insert in table?
     */
    public function create(array $values): bool
    {
        $query = "INSERT INTO product_sales (sale_id, product_id, current_value, current_tax) 
            VALUES (:sale_id, :product_id, :current_value, :current_tax)";

        $dbResponse = $this->dbConnection->prepare($query);
        return $dbResponse->execute($values) ?? throw new Exception('Error creating product_sales.', 400);
    }
}
