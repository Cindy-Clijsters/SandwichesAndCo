<?php
declare(strict_types = 1);

namespace App\Data;

use App\Entities\Administrator;

use PDO;
use DateTime;

class AdministratorDAO
{
    /**
     * Get the information of the administrator specified by the id
     * 
     * @param int $id
     * 
     * @return Administrator|null
     */
    public function getById(int $id):?Administrator
    {
        $administrator = null;
       
        // Generate the query
        $sql = "SELECT id, first_name, last_name, email, password, status, created_at
                FROM administrators
                WHERE id = :id";
        
        // Open the connection
        $pdo = DbConfig::getPDO();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        // Get the information
        if ($stmt->rowCount() > 0) {
            
            $row           = $stmt->fetch(PDO::FETCH_ASSOC);
            $administrator = $this->createFromDbRow($row);

        }
        
        // Return the result
        return $administrator;
    }
    
    /**
     * Get the information of the administrator specified by the email address
     * 
     * @param string $email
     * 
     * @return Administrator|null
     */
    public function getByEmail(string $email):?Administrator
    {
        $administrator = null;
       
        // Generate the query
        $sql = "SELECT id, first_name, last_name, email, password, status, created_at
                FROM administrators
                WHERE email = :email";
        
        // Open the connection
        $pdo = DbConfig::getPDO();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        // Get the information
        if ($stmt->rowCount() > 0) {
            
            $row           = $stmt->fetch(PDO::FETCH_ASSOC);
            $administrator = $this->createFromDbRow($row);

        }
        
        // Return the result
        return $administrator;
    }
    
    /**
     * Create a administrator from database row
     * 
     * @param array $row
     * 
     * @return Administrator|null
     */
    private function createFromDbRow(array $row):?Administrator
    {
        $administrator = null;
        
        if (
            array_key_exists('first_name', $row)
            && array_key_exists('last_name', $row)
            && array_key_exists('email', $row) 
            && array_key_exists('password', $row)
            && array_key_exists('status', $row)
        ) {
            
            $administrator = new Administrator(
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['password'],
                $row['status']
            );
            
            if (array_key_exists('id', $row)) {
                $administrator->setId(intVal($row['id']));
            }
            
            if (array_key_exists('created_at', $row)) {
                $createdAt = new DateTime($row['created_at']);
                $administrator->setCreatedAt($createdAt);
            }
                        
        }
        
        return $administrator;
    }
}