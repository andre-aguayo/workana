<?php

namespace Src\Controller;

use Src\Model\Product\Product;
use Src\Model\Product\ProductParent;

class HomePageController
{
    public function index()
    {
        return (new Product)->getAllWithParent();
    }
}
