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
use Src\Controller\SaleController;

class Api
{
    public function __construct(
        private string $httpMethod,
        private string $uri,
        private array $request
    ) {
        if ((!is_array($request) || empty($request)) && $httpMethod === 'POST')
            $this->request = json_decode(file_get_contents("php://input"), true);
    }

    /**
     * Direct route to required controlle
     * @return string json object

     */
    public function route(): string
    {
        $uriPaths = explode('/', $this->uri);

        switch (true) {
            case ((new HomepageRequest)->index($uriPaths, $this->httpMethod)):
                $controllerResponse = (new HomePageController)->index();
                break;
            case ((new ProductRequest)->index($uriPaths, $this->httpMethod)):
                $controllerResponse = (new ProductController)->index($uriPaths[2]);
                break;
            case ((new ProductRequest)->create($uriPaths, $this->httpMethod, $this->request)):
                $controllerResponse = (new ProductController)->create($this->request);
                break;
            case ((new ProductCategoryRequest)->index($uriPaths, $this->httpMethod, $this->request)):
                $controllerResponse = (new ProductCategoryController)->index($this->request);
                break;
            case ((new ProductCategoryRequest)->create($uriPaths, $this->httpMethod, $this->request)):
                $controllerResponse = (new ProductCategoryController)->create($this->request);
                break;
            case ((new SaleRequest)->create($uriPaths, $this->httpMethod, $this->request)):
                $controllerResponse = (new SaleController)->create($this->request);
                break;
            default:
                throw new Exception('Page not found', 404);
                break;
        }

        return json_encode(['success' => true, 'data' => $controllerResponse]);
    }
}
