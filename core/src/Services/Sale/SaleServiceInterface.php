<?php

namespace Src\Services\Sale;

interface SaleServiceInterface
{
    /**
     * Realiza a venda descontando do estoque e verificando os valores vendidos
     * @throws Exceptions If dont create a sale or productSale
     */
    public function sale(array $sale): bool;
}
