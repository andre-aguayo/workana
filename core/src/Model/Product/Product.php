<?php

namespace Src\Model\Product;

use Src\Model\BaseModel;

/**
 * Is a parent tables
 */
enum ProductParent: string
{
    case ProductCategory = 'product_categories';
}

class Product extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->requiredColumns = ['name', 'value', 'stock', 'category_id'];
        $this->parentName = ProductParent::ProductCategory->value;
    }

    /**
     * Esta funçao eu teria colocado num Product Service com sua interface implementada,
     *  mas novamente, 
     * por conveniencia e poupar tempo estou coocando no modelo
     * 
     * records the sale of products by discounting the quantity in stock
     * @param int $quantity quantitu sold
     * @param int $productId product identifier
     * @return bool updated?
     */
    public function productSale(int $quantity, int $productId): bool
    {
        $query = "UPDATE products SET stock = :stock WHERE id = :id;";

        $dbResponse = $this->dbConnection->prepare($query);

        $product = $this->findById($productId);
        return $dbResponse->execute(['stock' => ($product['stock'] - $quantity), 'id' => $productId]);
    }
}
