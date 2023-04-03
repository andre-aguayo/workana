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
        return false;
    }
}
