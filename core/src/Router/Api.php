<?php

namespace Src\Router;

use Exception;
use Src\Controller\HomePageController;
use Src\Controller\Product\ProductCategoryController;
use Src\Controller\Product\ProductController;
use Src\Http\RequestValidate\HomepageRequest;
use Src\Http\RequestValidate\ProductCategoryRequest;
use Src\Http\RequestValidate\ProductRequest;
use Src\Http\RequestValidate\SaleRequest;
use Src\Controller\Product\SaleController;

class Api
{
    public function __construct(
        private string $httpMethod,
        private string $uri,
        private array $request
    ) {
    }

    public function route()
    {
        $uriPaths = explode('/', $this->uri);

        switch (true) {
            case ((new HomepageRequest)->index($uriPaths, $this->httpMethod)):
                (new HomePageController)->index();
                break;
            case ((new ProductRequest)->index($uriPaths, $this->httpMethod)):
                new ProductController;
                break;
            case ((new ProductRequest)->create($uriPaths, $this->httpMethod, $this->request)):
                new ProductController;
                break;
            case ((new ProductCategoryRequest)->create($uriPaths, $this->httpMethod, $this->request)):
                new ProductCategoryController;
                break;
            case ((new SaleRequest)->create($uriPaths, $this->httpMethod, $this->request)):
                new SaleController;
                break;
            default:
                throw new Exception('Page not found', 404);
                break;
        }
    }
}
