<?php

namespace Src\Http\RequestValidate;

class ProductRequest
{
    public function index(array $uriPaths, string $httpMethod): bool
    {
        return $uriPaths[1] === 'product' && is_numeric($uriPaths[2]) && $httpMethod === 'GET';
    }

    public function create(array $uriPaths, string $httpMethod, array $request): bool
    {
        return $uriPaths[1] === 'product' &&
            $uriPaths[2] === 'create' &&
            $httpMethod === 'POST' &&
            ( //Product request params
                !empty($request['name']) && //check product name
                is_string($request['name']) && //check product name
                !empty($request['value']) && //check value
                is_numeric($request['value']) && //check value
                $request['value'] >= 0 && //check value
                !empty($request['stock']) && //check product stock
                is_numeric($request['stock']) && //check product stock
                $request['stock'] >= 0 && //check product stock
                !empty($request['category_id']) && //check product_category_id
                is_numeric($request['category_id']) //check product_category_id
            );
    }
}
