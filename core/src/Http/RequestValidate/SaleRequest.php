<?php

namespace Src\Http\RequestValidate;

class SaleRequest
{
    public function create(array $uriPaths, string $httpMethod, array $request): bool
    {
        return $uriPaths[1] === 'sale' &&
            $uriPaths[2] === 'create' &&
            $httpMethod === 'POST' &&
            ( //Sale request params
                is_numeric($request['total_value']) &&
                $request['total_value'] >= 0 &&
                is_numeric($request['total_tax']) &&
                $request['total_tax'] >= 0 &&
                count($request) === 3 //maximum parameters
            ) &&
            ( //Products sale
                is_array($request['product_sales']) &&
                $this->checkProductArray($request['product_sales'])
            );
    }

    /**
     * Check products sales from request
     * @param array $productSales from request
     * @return bool (true if all are valid)
     */
    private function checkProductArray(array $productSales): bool
    {
        $check = true;
        foreach ($productSales as $productSale) {
            if (
                is_numeric($productSale['product_id']) &&
                $productSale['product_id'] > 0 &&
                is_numeric($productSale['quantity']) &&
                $productSale['quantity'] > 0 &&
                is_numeric($productSale['current_value']) &&
                $productSale['current_value'] > 0 &&
                is_numeric($productSale['current_tax']) &&
                $productSale['current_tax'] > 0 &&
                count($productSale) === 4
            ) {
                $check = false;
            }
        }
        return !$check;
    }
}
