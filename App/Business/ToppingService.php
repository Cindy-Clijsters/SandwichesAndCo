<?php
declare(strict_types = 1);

namespace App\Business;

use App\Data\ToppingDAO;
use App\Entities\Topping;

use stdClass;

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
    
    /**
     * Get an topping by it's name
     * 
     * @param string $name
     * 
     * @return Topping|null
     */
    public function getByName(string $name):?Topping
    {
        $toppingDAO = new ToppingDAO();
        $topping    = $toppingDAO->getByName($name);
        
        return $topping;
    }
    
    /**
     * Insert a new topping
     * 
     * @param Topping $topping
     * 
     * @return Topping
     */
    public function insert(Topping $topping):Topping 
    {
        $toppingDAO = new ToppingDAO();
        $newTopping = $toppingDAO->insert($topping);
        
        return $topping;
    }
    
    
    /**
     * Validate the topping
     * 
     * @param stdClass $tmpTopping
     * 
     * @return stdClass
     */
    public function validateTopping(stdClass $tmpTopping):stdClass 
    {
        $validationSvc = new ValidationService();
        
        $errors          = new stdClass();
        $errors->isValid = true;
        
        $toppingErrors = $validationSvc->validateTextField($tmpTopping->name, 100);
        
        if ($toppingErrors === '') {
            $toppingErrors = $validationSvc->checkUniqueToppingName(
                $tmpTopping->name,
                $tmpTopping->id
            );
        }
        
        if ($toppingErrors !== '') {
            $errors->name    = $toppingErrors;
            $errors->isValid = false;
        }
        
        $statusErrors = $validationSvc->validateTextField($tmpTopping->status, 20);
        
        if ($statusErrors !== '') {
            $errors->status  = $statusErrors;
            $errors->isValid = false;
        }
        
        return $errors;
    }
}