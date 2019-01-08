<?php
declare(strict_types = 1);

namespace App\Business;

use App\Data\ProductCategoryDAO;

class ProductCategoryService
{
    /**
     * Get an array with all product categories
     * 
     * @return array
     */
    public function getAll():array
    {
        $productCategoryDAO = new ProductCategoryDAO();
        $productCategories  = $productCategoryDAO->getAll();
        
        return $productCategories;
    }
}