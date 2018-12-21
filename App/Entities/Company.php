<?php
declare(strict_types = 1);

namespace App\Entities;

/**
 * Class Company
 * 
 * Hold the properties of the company
 */
class Company
{
    private $id;
    private $name;
    private $address;
    private $postalCode;
    private $city;
    private $telephone;
    private $email;
    private $vatNumber;
    private $aboutUsSummary;
    private $aboutUs;
    
    /**
     * Constructor function 
     * 
     * @param string $name
     * @param string $email
     * 
     * @return void
     */
    public function __construct(string $name, string $email)
    {
        $this->name  = $name;
        $this->email = $email;
    }
    
    /**
     * Set the id of the company
     * 
     * @param int $id
     * 
     * @return Company
     */
    public function setId(int $id):Company
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * Return the id of the company
     * 
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }
    
    /**
     * Set the name of the company
     * 
     * @param string $name
     * 
     * @return Company
     */
    public function setName(string $name):Company
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Get the name of the company
     * 
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }
    
    /**
     * Set the address of the company
     * 
     * @param string|null $address
     * 
     * @return Company
     */
    public function setAddress(?string $address):Company
    {
        $this->address = $address;
        return $this;
    }
    
    /**
     * Get the address of the company
     * 
     * @return string|null
     */
    public function getAddress():?string
    {
        return $this->address;
    }
    
    /**
     * Set the postal code of the company
     * 
     * @param string|null $postalCode
     * 
     * @return Company
     */
    public function setPostalCode(string $postalCode):Company
    {
        $this->postalCode = $postalCode;
        return $this;
    }
    
    /**
     * Get the postal code of the company
     * 
     * @return string
     */
    public function getPostalCode():?string
    {
        return $this->postalCode;
    }
    
    /**
     * Set the city of a company
     * 
     * @param string|null $city
     * 
     * @return Company
     */
    public function setCity(?string $city):Company
    {
        $this->city = $city;
        return $this;
    }
    
    /**
     * Get the city of the company
     * 
     * @return string|null
     */
    public function getCity():?string
    {
        return $this->city;
    }
    
    /**
     * Set the telephone of the company
     * 
     * @param string|null $telephone
     * 
     * @return Company
     */
    public function setTelephone(?string $telephone):Company
    {
        $this->telephone = $telephone;
        return $this;
    }
    
    /**
     * Get the telephone of the company
     * 
     * @return string|null
     */
    public function getTelephone():?string
    {
        return $this->telephone;
    }
    
    /**
     * Set the email of the company
     * 
     * @param string|null $email
     * 
     * @return Company
     */
    public function setEmail(?string $email):Company
    {
        $this->email = $email;
        return $this;
    }
    
    /**
     * Get the email of the company
     * 
     * @return string|null
     */
    public function getEmail():?string
    {       
        return $this->email;
    }
    
    /**
     * Set the vat number of the company
     * 
     * @param string|null $vatNumber
     * 
     * @return Company
     */
    public function setVatNumber(?string $vatNumber):Company
    {
        $this->vatNumber = $vatNumber;
        return $this;
    }
    
    /**
     * Get the vat number of the company
     * 
     * @return string|null
     */
    public function getVatNumber():?string
    { 
        return $this->vatNumber;
    }
       
    /**
     * Set the about us summary of the company
     * 
     * @param string|null $aboutUsSummary
     * 
     * @return Company
     */
    public function setAboutUsSummary(?string $aboutUsSummary):Company 
    {
        $this->aboutUsSummary = $aboutUsSummary;
        return $this;
    }
    
    /**
     * Get the about us information of the company
     * 
     * @return string|null
     */
    public function getAboutUsSummary():?string
    {
        return $this->aboutUsSummary;
    }
    
    /**
     * Set the about us information of the company
     * 
     * @param string|null $aboutUs
     * 
     * @return Company
     */
    public function setAboutUs(?string $aboutUs):Company
    {
        $this->aboutUs = $aboutUs;
        return $this;
    }
    
    /**
     * Get the about us information of the company
     * 
     * @return string|null
     */
    public function getAboutUs():?string
    {
        return $this->aboutUs;
    }
}