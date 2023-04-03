<?php

namespace Src\Controller\Product;

use Src\Model\Product\ProductCategory;

class ProductCategoryController
{
    public function __construct(
        private ProductCategory $productCategory = new ProductCategory
    ) {
    }

    /**
     * @param array $requestParams is a params of create product
     * @return array product
     */
    public function create(array $requestParams)
    {
        return ['created' => $this->productCategory->create($requestParams)];
    }
}
