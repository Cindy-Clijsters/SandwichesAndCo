<?php
declare (strict_types = 1);

namespace App\Data;

use App\Entities\Product;
use App\Entities\ProductCategory;

use PDO;

class ProductDAO
{
    /**
     * Get an array with all the products
     * 
     * @return array
     */
    public function getAll():array
    {
        $result = [];
        
        // Generate the query
        $sql = "SELECT p.id, p.name, p.price, p.status, pc.id AS pc_id, pc.name AS pc_name, pc.status as pc_status
                FROM products p
                JOIN product_categories pc ON pc.id = p.product_category_id
                ORDER BY name";
        
        // Open the connection
        $pdo = DBConfig::getPdo();
        
        // Execute the query
        $resultSet = $pdo->query($sql);
        
        // Add the results to the array
        foreach ($resultSet as $row) {
            $product = $this->createFromDbRow($row);
            
            if ($product !== null) {
                array_push($result, $product);
            }
        }
        
        // Close the connection
        $pdo = null;
        
        // Return the result
        return $result;
    }
    
    /**
     * Get the product by it's name
     * 
     * @param string $name
     * 
     * @return Product|null
     */
    public function getByName(string $name): ?Product
    {
        $product = null;
        
        // Generate the query
        $sql = "SELECT p.id, p.name, p.price, p.status, pc.id AS pc_id, pc.name AS pc_name, pc.status as pc_status
                FROM products p
                JOIN product_categories pc ON pc.id = p.product_category_id
                WHERE p.name = :name
                ORDER BY name";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name' => $name]);
        
        // Get the information of the topping
        if ($stmt->rowCount() > 0) {
            $row     = $stmt->fetch(PDO::FETCH_ASSOC);
            $product = $this->createFromDbRow($row);
        }
        
        // Close the connection
        $pdo = null;
        
        return $product;
    }
    
    /**
     * Insert a new product
     * 
     * @param int $productCategoryId
     * @param string $name
     * @param float $price
     * @param string $status
     * 
     * @return int
     */
    public function insert(
        int $productCategoryId,
        string $name,
        float $price,
        string $status
    ):int {
        // Generate the query
        $sql = "INSERT INTO products (product_category_id, name, price, status)
                VALUES (:productCategoryId, :name, :price, :status)";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':productCategoryId' => $productCategoryId,
            ':name'              => $name,
            ':price'             => $price,
            ':status'            => $status
        ]);
        
        // Update the id of the product
        $productId = intVal($pdo->lastInsertId());
        
        // Close the connection
        $pdo = null;
        
        // Return the product
        return $productId;
    }
    
    /**
     * Add a topping to a product
     * 
     * @param int $productId
     * @param int $toppingId
     * 
     * @return void
     */
    public function addTopping(int $productId, int $toppingId)
    {
        // Generate the query
        $sql = "INSERT INTO product_toppings(product_id, topping_id)
                VALUES (:productId, :toppingId)";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':productId' => $productId,
            ':toppingId' => $toppingId
        ]);
        
        // Close the connection
        $pdo = null;                
    }
        
    
    /**
     * Create a product from a database row
     * 
     * @param array $row
     * 
     * @return Product|null
     */
    private function createFromDbRow(array $row):?Product 
    {   
        $product = null;
        
        if (
            array_key_exists('pc_id', $row)
            && array_key_exists('pc_name', $row) 
            && array_key_exists('pc_status', $row) 
        ) {
            
            $productCategory = ProductCategory::map(
                intVal($row['pc_id']),
                $row['pc_name'],
                $row['pc_status']
            );
            
            if (
                array_key_exists('id', $row)
                && array_key_exists('name', $row)
                && array_key_exists('price', $row)
                && array_key_exists('status', $row)
            ) {
                $product = Product::map(
                    intVal($row['id']),
                    $productCategory,
                    $row['name'],
                    $row['price'],
                    $row['status']
                );
            }
        }
        
        return $product;
    }
}