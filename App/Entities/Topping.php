<?php
declare(strict_types = 1);
 
namespace App\Entities;
 
/**
 * Class Topping
 * 
 * Hold the properties of a topping
 */
class Topping
{
    private $id;
    private $name;
    private $status;
    
    private static $idMap = [];
     
    const STATUS_ACTIVE   = "active";
    const STATUS_INACTIVE = "inactive";
    
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
    ){
        $this->name   = $name;
        $this->status = $status;
    }
    
    /**
     * Map a topping
     * 
     * @param int $id
     * @param string $name
     * @param string $status
     * 
     * @return Topping
     */
    public static function map(
        int $id,
        string $name,
        string $status
    ): Topping {
        
        if (!isset(self::$idMap[$id])) {
            
            $topping = new Topping(
                $name,
                $status
            );
            
            $topping->setId($id);
            
            self::$idMap[$id] = $topping;
            
        }
        
        return self::$idMap[$id];
    }
    
    /*
     * Set the id of the topping
     * 
     * @param int $id
     * 
     * @return Topping
     */
    public function setId(int $id):Topping
    {
        $this->id = $id;
        return $this;
    }  
    
    /**
     * Get the id of the topping
     * 
     * @return int
     */
    public function getId():int
    {
       return $this->id; 
    }
    
    /**
     * Set the name of the topping 
     * 
     * @param string $name
     * 
     * @return Topping
     */
    public function setName(string $name):Topping
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Get the name of the topping
     * 
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }
    
    /**
     * Set the status of the topping
     * 
     * @param string $status
     * 
     * @return Topping
     */
    public function setStatus(string $status):Topping
    {
        $this->status = $status;
        return $this;
    }
    
    /**
     * Get the status of the topping
     * 
     * @return string
     */
    public function getStatus():string
    {
        return $this->status;
    }
    
    /**
     * Get an array with all statuses
     * 
     * @return array
     */
    public static function getAllStatuses():array
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE
        ];
    }
}