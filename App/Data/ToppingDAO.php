<?php
declare(strict_types = 1);

namespace App\Data;

use App\Entities\Topping;

use PDO;

class ToppingDAO
{
    public function getAll():array
    {
        $result = [];
        
        // Generate the query
        $sql = "SELECT id, name, status
                FROM toppings
                ORDER BY name";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $resultSet = $pdo->query($sql);
        
        // Add the results to the array
        foreach ($resultSet as $row) {
            
            $topping = $this->createFromDbRow($row);
            
            if ($topping !== null) {
                array_push($result, $topping);
            }
            
        }
        
        // Close the connection
        $pdo = null;
        
        // Return the result
        return $result;
    }
    
    /**
     * Create a topping from a database row
     * 
     * @param array $row
     * 
     * @return Topping|null
     */
    private function createFromDbRow(array $row):?Topping
    {
        $topping = null;
        
        if (
            array_key_exists('name', $row)
            && array_key_exists('status', $row)
        ) {
            $topping = new Topping(
                $row['name'],
                $row['status']
            );
            
            if (array_key_exists('id', $row)) {
                $topping->setId(intVal($row['id']));
            }
        }
        
        return $topping;
    }
    
}