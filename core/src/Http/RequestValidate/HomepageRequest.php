<?php

namespace Src\Http\RequestValidate;

/**
 * To RequestValidate home page requests
 */
class HomepageRequest
{
    static public function index(array $arrUri, string $httpMethond): bool
    {
        return ($arrUri[1] === '' || is_numeric($arrUri[1])) && $httpMethond === 'GET';
    }
}
