<?php
declare(strict_types = 1);

namespace App\Business;

use App\Data\ToppingDAO;

class ToppingService
{
    /**
     * Get an array with all toppings
     * 
     * @return array
     */
    public function getAll():array
    {
        $toppingDAO = new ToppingDAO();
        $toppings   = $toppingDAO->getAll();
        
        return $toppings;
    }
}