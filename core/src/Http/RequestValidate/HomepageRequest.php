<?php

namespace Src\Http\RequestValidate;

/**
 * To RequestValidate home page requests
 */
class HomepageRequest
{
    static public function index(array $uriExplode, string $httpMethond): bool
    {
        return ($uriExplode[1] === '' || is_numeric($uriExplode[1])) && $httpMethond === 'GET';
    }
}
