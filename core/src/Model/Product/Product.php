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
}
