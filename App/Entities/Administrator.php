<?php
declare(strict_types = 1);

namespace App\Entities;

use DateTime;

class Administrator extends Person
{    
    private static $idMap = [];
    
    /**
     * Constructor function
     * 
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string $status
     * 
     * @return void
     */
    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $status
    ) {
        parent::__construct(
            $firstName,
            $lastName,
            $email,
            $password,
            $status
        );
    }
    
    /**
     * Map the administrators
     * 
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string $status
     * @param datetime $createdAt
     * 
     * @return Administrator
     */
    public static function map(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $status,
        DateTime $createdAt
    ): Administrator {
        
        if (!isset(self::$idMap[$id])) {
            
            $administrator = new Administrator(
                $firstName,
                $lastName,
                $email,
                $password,
                $status
            );
            
            $administrator->setId($id);
            $administrator->setCreatedAt($createdAt);
            
            self::$idMap[$id] = $administrator;
            
        }
        
        return self::$idMap[$id];
        
    }
    
}