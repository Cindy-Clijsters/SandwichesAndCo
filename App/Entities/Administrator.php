<?php
declare(strict_types = 1);

namespace App\Entities;

class Administrator extends Person
{    
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
    
}