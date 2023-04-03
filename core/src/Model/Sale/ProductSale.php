<?php

namespace Src\Model\Sale;

use Exception;
use Src\Model\BaseModel;
use Src\Model\Product\Product;

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
        $this->requiredColumns = ['sale_id', 'product_id', 'quantity', 'current_value', 'current_tax'];
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
            $this->create([...$productSale, 'sale_id' => $saleId]);

            //discount into product stock the sale
            (new Product)->productSale($productSale['quantity'], $productSale['product_id']);
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
        $dbResponse = $this->dbConnection->prepare(
            "INSERT INTO product_sales (sale_id, product_id, quantity, current_value, current_tax) 
                     VALUES (:sale_id, :product_id, :quantity, :current_value, :current_tax)"
        );
        return $dbResponse->execute($values);
    }
}
