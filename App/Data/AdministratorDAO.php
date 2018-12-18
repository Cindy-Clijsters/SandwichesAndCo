<?php
declare(strict_types = 1);

namespace App\Data;

use App\Entities\Administrator;

use PDO;
use DateTime;

class AdministratorDAO
{
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
            
            $row       = $stmt->fetch(PDO::FETCH_ASSOC);
            $createdAt = new DateTime($row['created_at']);
            
            $administrator = new Administrator(
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['password'],
                $row['status']
            );
            
            $administrator->setId(intVal($row['id']))
                          ->setCreatedAt($createdAt);
        }
        
        // Return the result
        return $administrator;
    }
}