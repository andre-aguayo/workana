<?php

namespace Src\Services\Sale;

use Exception;
use Src\Model\Sale\Sale;
use Src\Model\Product\Product;
use Src\Model\Product\ProductCategory;
use Src\Model\Sale\ProductSale;

class SaleService implements SaleServiceInterface
{
    public function __construct(
        private Sale $sale = new Sale(),
        private ProductSale $productSale = new ProductSale
    ) {
    }

    /**
     * Realiza a venda descontando do estoque e verificando os valores vendidos
     * @throws Exceptions If dont create a sale or productSale
     */
    public function sale(array $sale): bool
    {
        if ($this->verifySale($sale))
            return $this->registrateSale($sale);

        return false;
    }

    /**
     * Aqui seria onde verificaria o saldo do usuario e descontaria do saldo atual
     * Utilizando $_SESSION para verificar se esta logado...
     */
    private function verifySale(array $sale): bool
    {
        foreach ($sale['product_sales'] as $productSale) {
            //Eu teria colocado esta requisiçao separada em um product service mas por conveiencia e para pupar tempo deixei aqui mesmo
            $product = (new Product)->findById($productSale['product_id']);

            $productCategory = (new ProductCategory)->findById($product['category_id']);

            $check = $product['stock'] > $productSale['quantity'] &&
                $product['value'] == $productSale['current_value'] &&
                $productCategory['tax'] == $productSale['current_tax'];

            if (!$check)
                break;
        }

        return $check;
    }

    private function registrateSale(array $sale)
    {
        try {
            $this->sale->beginTransaction(); //Create transaction
            //registrate sale into database
            $this->sale->create($sale);

            //Create ProductSale and update stock into products table
            $this->productSale->createMany(
                $sale['product_sales'],
                $this->sale->getLastInsertId()
            );

            $this->sale->commit();
        } catch (Exception $e) {
            $this->sale->rollBack();
            throw new Exception($e->getMessage(), 400);
        }
    }
}
