<?php

namespace Src\Model\Product;

use Src\Model\BaseModel;

/**
 * Is a parent tables
 */
enum ProductCategoryChild: string
{
    case ProductCategory = 'products';
}

class ProductCategory extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->requiredColumns = ['name', 'tax'];
    }
}
