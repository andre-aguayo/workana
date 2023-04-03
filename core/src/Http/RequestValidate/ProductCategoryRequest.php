<?php

namespace Src\Http\RequestValidate;

class ProductCategoryRequest
{
    public function create(array $uriPaths, string $httpMethod, array $request): bool
    {
        return $uriPaths[1] === 'product-category' &&
            $uriPaths[2] === 'create' &&
            $httpMethod === 'POST' &&
            ( //Product Category request params
                is_string($request['name']) && //check category name
                is_numeric($request['tax']) && //check tax
                $request['tax'] >= 0 && //check tax
                count($request) === 2 //maximum parameters
            );
    }
}
