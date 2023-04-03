<?php

namespace Src\Controller\Product;

use Src\Model\Product\Product;

class ProductController
{

    public function __construct(private Product $product = new Product)
    {
    }

    /**
     * Get product with product category
     */
    public function index(int $uriParam): array
    {
        return ['product' => $this->product->findById($uriParam)];
    }

    /**
     * @param array $requestParams is a params of create product
     * @return array product
     */
    public function create(array $requestParams)
    {
        return ['created' => $this->product->create($requestParams)];
    }
}
