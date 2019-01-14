<?php
declare(strict_types = 1);

namespace App\Business;

use App\Data\ProductDAO;

class ProductService
{
    /**
     * Get an array with all products
     * 
     * @return array
     */
    public function getAll():array
    {
        $productDAO = new ProductDAO();
        $products   = $productDAO->getAll();
        
        return $products;
    }
}