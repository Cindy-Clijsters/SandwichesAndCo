<?php
declare(strict_types = 1);

namespace App\Entities;

use DateTime;

abstract class Person
{
    const STATUS_ACTIVE  = "active";
    
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $status;
    private $createdAt;
    
    /**
     * Constructor function
     * 
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * 
     * @return void
     */
    protected function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $status
    ) {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->email     = $email;
        $this->password  = $password;
        $this->status    = $status;
    }
    
    /**
     * Set the id
     * 
     * @param int $id
     * 
     * @return self
     */
    public function setId(int $id):self
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * Return the id
     * 
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }
    
    /**
     * Set the first name
     * 
     * @param string $firstName
     * 
     * @return self
     */
    public function setFirstName(string $firstName):self
    {
        $this->firstName = $firstName;
        return $this;
    }
    
    /**
     * Get the first name
     * 
     * @return string
     */
    public function getFirstName():string
    {
        return $this->firstName;
    }
    
    /**
     * Set the last name
     * 
     * @param string $lastName
     * 
     * @return self
     */
    public function setLastName(string $lastName):self
    {
        $this->lastName = $lastName;
        return $this;
    }
    
    /**
     * Get the last name
     * 
     * @return string
     */
    public function getLastName():string
    {
        return $this->lastName;
    }
    
    /**
     * Set the email address
     * 
     * @param string $email
     * 
     * @return self
     */
    public function setEmail(string $email):self
    {
        $this->email = $email;
        return $this;
    }
    
    /**
     * Get the email address
     * 
     * @return string
     */
    public function getEmail():string
    {
        return $this->email;
    }
    
    /**
     * Set the password
     * 
     * @param string $password
     * 
     * @return self
     */
    public function setPassword(string $password):self
    {
        $this->password = $password;
        return $this;
    }
    
    /**
     * Return the password
     * 
     * @return string
     */
    public function getPassword():string
    {
        return $this->password;
    }
    
    /**
     * Set the status
     * 
     * @param string $status
     * 
     * @return self
     */
    public function setStatus(string $status):self
    {
        $this->status = $status;
        return $this;
    }
    
    /**
     * Get the status
     * 
     * @return string
     */
    public function getStatus():string
    {
        return $this->status;
    }
    
    /**
     * Set the creation date 
     * 
     * @param DateTime $createdAt
     * 
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt):self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    
    /**
     * Get the creation date
     * 
     * @return DateTime
     */
    public function getCreatedAt():DateTime
    {
        return $this->createdAt;
    }    
}