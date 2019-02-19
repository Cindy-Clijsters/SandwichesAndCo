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
     * Get all toppings with a specified status
     * 
     * @param string $status
     * 
     * @return array
     */
    public function filterByStatus(string $status): array
    {
        $result = [];
        
        // Generate the query

        $sql = "SELECT id, name, status
                FROM toppings
                WHERE status = :status
                ORDER BY name";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $resultSet = $pdo->prepare($sql);
        $resultSet->execute([':status' => $status]);
        
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
     * Get an array with the active toppings
     * 
     * @return array
     */
    public function getActiveToppingIds(): array
    {
        $result = [];
        
        // Generate the query
        $sql = "SELECT id
                FROM toppings
                WHERE status = :status";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $resultSet = $pdo->prepare($sql);
        $resultSet->execute([':status' => Topping::STATUS_ACTIVE]);
        
        // Add the ids to the array  
        foreach ($resultSet as $row) {
            array_push($result, intVal($row['id']));
        }
        
        // Close the connection
        $pdo = null;
        
        // Return the result
        return $result;        
    }
    
    /**
     * Get the information of a topping specified by it's id
     * 
     * @param int $id
     * 
     * @return Topping|null
     */
    public function getById(int $id):?Topping
    {
        $topping = null;
        
        // Generate the query
        $sql = "SELECT id, name, status
                FROM toppings 
                WHERE id = :id";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        if ($stmt->rowCount() > 0) {
            $row     = $stmt->fetch(PDO::FETCH_ASSOC);
            $topping = $this->createFromDbRow($row);
        }
        
        // Close the connection
        $pdo = null;
        
        // Return the result
        return $topping;  
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
        
        // Update the id of the topping
        $toppingId = $pdo->lastInsertId();
        $topping->setId(intVal($toppingId));
        
        // Close the connection
        $pdo = null;
        
        // Return the topping
        return $topping;
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
        // Generate the query
        $sql = "UPDATE toppings 
                SET name = :name,
                    status = :status
                WHERE id = :id";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'   => $topping->getName(),
            ':status' => $topping->getStatus(),
            ':id'     => $topping->getId()
        ]);
        
        // Close the connection
        $pdo = null;         
    }
    
    /**
     * Delete an existing topping
     * 
     * @param int $id
     * 
     * @return void
     */
    public function delete(int $id):void
    {
        // Generate the query
        $sql = "DELETE 
                FROM toppings
                WHERE id = :id";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        
        // Close the connection
        $pdo = null;
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
            array_key_exists('id', $row)
            && array_key_exists('name', $row)
            && array_key_exists('status', $row)
        ) {
            $topping = Topping::map(
                intVal($row['id']),
                $row['name'],
                $row['status']
            );
        }
        
        return $topping;
    }
    
}