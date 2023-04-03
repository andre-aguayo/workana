<?php

namespace Src\Controller;

use Src\Services\Sale\SaleService;

class SaleController
{
    public function __construct(private SaleService $sale = new SaleService())
    {
    }

    /**
     * @param array $requestParams is a params of create product
     * @return array product
     */
    public function create(array $requestParams)
    {
        return ['created' => $this->sale->sale($requestParams)];
    }
}
