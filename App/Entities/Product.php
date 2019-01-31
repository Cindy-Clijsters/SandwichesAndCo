<?php
declare(strict_types = 1);

namespace App\Entities;

class Product 
{
    private $id;
    private $productCategory;
    private $name;
    private $price;
    private $toppings = [];
    private $status;
    
    private static $idMap = [];
    
    const STATUS_ACTIVE   = "active";
    const STATUS_INACTIVE = "inactive";
    
    /**
     * Constructor function
     * 
     * @param ProductCategory $productCategory
     * @param string $name
     * @param float $price
     * @param string $status
     * 
     * @return void
     */
    public function __construct(
        ProductCategory $productCategory,
        string $name,
        float $price,
        string $status
    ) {
        $this->productCategory = $productCategory;
        $this->name            = $name;
        $this->price           = $price;
        $this->status          = $status; 
    }
    
    /**
     * Map a new product
     * 
     * @param int $id
     * @param ProductCategory $productCategory
     * @param string $name
     * @param float $price
     * @param string $status
     * 
     * @return Product
     */
    public static function map(
        int $id,
        ProductCategory $productCategory,
        string $name,
        float $price,
        string $status
    ): Product {
        
        if (!isset(self::$idMap[$id])) {
            
            $product = new Product(
                $productCategory,
                $name,
                $price,
                $status
            );
            
            $product->setId($id);
            
            self::$idMap[$id] = $product;
            
        }
        
        return self::$idMap[$id];
    }
    
    /**
     * Set the id
     * 
     * @param int $id
     * 
     * @return Product
     */
    public function setId(int $id):Product 
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * Get the id
     * 
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }
    
    /**
     * Set the product category
     * 
     * @param ProductCategory $productCategory
     * 
     * @return Product
     */
    public function setProductCategory(ProductCategory $productCategory):Product 
    {
        $this->productCategory = $productCategory;
        return $this;
    }
    
    /**
     * Get the product category
     * 
     * @return ProductCategory
     */
    public function getProductCategory():ProductCategory 
    {
        return $this->productCategory;
    }
    
    /**
     * Set the name
     * 
     * @param string $name
     * 
     * @return Product
     */
    public function setName(string $name):Product
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Get the name 
     * 
     * @return string
     */
    public function getName():string 
    {
        return $this->name;
    }
    
    /**
     * Set the price
     * 
     * @param float $price
     * 
     * @return Product
     */
    public function setPrice(float $price):Product 
    {
        $this->price = $price;
        return $this;
    }
    
    /**
     * Get the price
     * 
     * @return float
     */
    public function getPrice():float 
    {
        return $this->price;
    }
    
    /**
     * Add a topping
     * 
     * @param Topping $topping
     * 
     * @return Product
     */
    public function addTopping(Topping $topping):Product 
    {
        $this->toppings[] = $topping;
    }
    
    /**
     * Get the toppings
     * @return array
     */
    public function getToppings():array
    {
        return $this->toppings;
    }
    
    /**
     * Set the status of a product
     * 
     * @param string $status
     * 
     * @return Product
     */
    public function setStatus(string $status):Product 
    {
        $this->status = $status;
        return $this;
    }
    
    /**
     * Get the status of a product
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