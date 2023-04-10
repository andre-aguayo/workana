<?php

namespace Src\Services\Sale;

use Src\Config\Database;
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

        throw new Exception('Invalid operation in sale products.', 400);
    }

    /**
     * Aqui seria onde verificaria o saldo do usuario e descontaria do saldo atual
     * Utilizando $_SESSION para verificar se esta logado...
     */
    private function verifySale(array $sale): bool
    {
        $totalTax = 0;
        $totalValue = 0;
        foreach ($sale['product_sales'] as $productSale) {
            //Eu teria colocado esta requisiçao separada em um product service mas por conveiencia e para pupar tempo deixei aqui mesmo
            $product = (new Product)->findById($productSale['id']);

            $productCategory = (new ProductCategory)->findById($product['category_id']);

            $check = $product['stock'] >= $productSale['quantity'] &&
                $product['value'] == $productSale['current_value'] &&
                $productCategory['tax'] == $productSale['current_tax'];

            $totalTax += $productSale['current_tax'] * $productSale['quantity'];
            $totalValue += $productSale['current_value'] * $productSale['quantity'] / 100;

            if (!$check)
                break;
        }
        return $check && $sale['total_tax'] == $totalTax;
    }

    private function registrateSale(array $sale)
    {
        try {
            $db = new Database();
            $db->beginTransaction(); //Create transaction
            //registrate sale into database
            $this->sale->create($sale);
            $saleId = $this->sale->getLastInsertId();
            $this->sale->__destruct();

            //Create ProductSale and update stock into products table
            $this->productSale->createMany(
                $sale['product_sales'],
                $saleId
            );

            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw new Exception($e->getMessage(), 400);
        }
        return true;
    }
}
