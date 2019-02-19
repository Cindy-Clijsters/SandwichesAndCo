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
     * Get all toppings with a specified status
     * 
     * @param string $status
     * 
     * @return array
     */
    public function filterByStatus(string $status): array
    {
        $toppingDAO = new ToppingDAO();
        $toppings   = $toppingDAO->filterByStatus($status);
        
        return $toppings;
    }
    
    /**
     * Get the ID's of all active toppings
     * 
     * @return array
     */
    public function getActiveToppingIds(): array
    {
        $toppingDAO = new ToppingDAO();
        $toppingIds = $toppingDAO->getActiveToppingIds();
        
        return $toppingIds;
    }
    
    /**
     * Get a topping by it's id
     * 
     * @param int $id
     * 
     * @return Topping|null
     */
    public function getById(int $id):?Topping
    {
        $toppingDAO = new ToppingDAO();
        $topping    = $toppingDAO->getById($id);
        
        return $topping;
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
        
        return $newTopping;
    }
    
    /**
     * Update an existing topping
     * 
     * @param Topping $topping
     * 
     * @return void
     */
    public function update(Topping $topping):void
    {
        $toppingDAO = new ToppingDAO();
        $toppingDAO->update($topping);
    }
    
    /**
     * Delete a topping by its id
     * 
     * @param int $id
     * 
     * @return void
     */
    public function delete(int $id):void
    {
        $toppingDAO = new ToppingDAO();
        $toppingDAO->delete($id);
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
        
        if ($statusErrors === '') {
            $statusErrors = $validationSvc->checkInArray(
                $tmpTopping->status,
                Topping::getAllStatuses(),
                'status'
            );
        }
        
        if ($statusErrors !== '') {
            $errors->status  = $statusErrors;
            $errors->isValid = false;
        }
        
        return $errors;
    }
}