<?php
declare(strict_types = 1);

namespace App\Data;

use App\Entities\Topping;

use PDO;

class ToppingDAO
{
    /**
     * Get an array with all the toppings
     * 
     * @return array
     */
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
     * Get the information of a topping specified by it's name
     * 
     * @param string $name
     * 
     * @return Topping|null
     */
    public function getByName(string $name):?Topping
    {
        $topping = null;
        
        // Generate the query
        $sql = "SELECT id, name, status 
                FROM toppings 
                WHERE name = :name";
        
        // Open the connection 
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name' => $name]);
        
        // Get the information of the topping
        if ($stmt->rowCount() > 0) {
            $row     = $stmt->fetch(PDO::FETCH_ASSOC);
            $topping = $this->createFromDbRow($row);
        }
        
        // Close the db connection
        $pdo = null;
        
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
        // Generate the query
        $sql = "INSERT INTO toppings(name, status) 
                VALUES (:name, :status)";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'   => $topping->getName(),
            ':status' => $topping->getStatus()
        ]);
        
        // Update the if of the topping
        $toppingId = $pdo->lastInsertId();
        $topping->setId(intVal($toppingId));
        
        // Close the connection
        $pdo = null;
        
        // Return the topping
        return $topping;
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