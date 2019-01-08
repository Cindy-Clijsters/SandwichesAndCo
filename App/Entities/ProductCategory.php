<?php
declare(strict_types = 1);

namespace App\Entities;

/**
 * Class ProductCategory
 * 
 * Hold the properties of the product category
 */
class ProductCategory
{
    private $id;
    private $name;
    private $status;
    
    const STATUS_ACTIVE   = "active";
    const STATUS_INACTIVE = "inactive";
    
    const STATUSES = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];
    
    /**
     * Constructor function
     * 
     * @param string $name
     * @param string $status
     * 
     * @return void
     */
    public function __construct(
        string $name,
        string $status = self::STATUS_ACTIVE
    ) {
        $this->name   = $name;
        $this->status = $status;
    }
    
    /**
     * Set the id of the product category
     * 
     * @param int $id
     * 
     * @return ProductCategory
     */
    public function setId(int $id):ProductCategory 
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * Get the id of the product category
     * 
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }
    
    /**
     * Set the name of the product category
     * 
     * @param string $name
     * 
     * @return ProductCategory
     */
    public function setName(string $name):ProductCategory 
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Get the name of the product category
     * 
     * @return string
     */
    public function getName():string 
    {
        return $this->name;
    }
    
    /**
     * Set the status of the product category
     * 
     * @param string $status
     * 
     * @return ProductCategory
     */
    public function setStatus(string $status):ProductCategory 
    {
        $this->status = $status;
        return $this;
    }
    
    /**
     * Get the status of the product category
     * 
     * @return string
     */
    public function getStatus():string
    {
        return $this->status;
    }
}