<?php

namespace Src\Controller;

use Src\Model\Sale\Sale;

class SaleController
{
    public function __construct(private Sale $sale = new Sale)
    {
    }

    /**
     * @param array $requestParams is a params of create product
     * @return array product
     */
    public function create(array $requestParams)
    {
        return ['created' => $this->sale->create($requestParams)];
    }
}
