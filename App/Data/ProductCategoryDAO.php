<?php
declare(strict_types = 1);

namespace App\Data;

use App\Entities\ProductCategory;

use PDO;

class ProductCategoryDAO
{
    /**
     * Get an array with all product categories
     * 
     * @return array
     */
    public function getAll():array
    {
        $result = [];
        
        // Generate the query
        $sql = "SELECT id, name, status
                FROM product_categories
                ORDER BY name";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $resultSet = $pdo->query($sql);
        
        // Add the results to the array
        foreach ($resultSet as $row) {
            $productCategory = $this->createFromDbRow($row);
            
            if ($productCategory !== null) {
                array_push($result, $productCategory);
            }
        }
        
        // Close the connection
        $pdo = null;
                
        // Return the result
        return $result;
    }
    
    /**
     * Get all categories with a specified status
     * 
     * @param string $status
     * 
     * @return array
     */
    public function filterByStatus(string $status)
    {
        $result = [];
        
        // Generate the query
        $sql = "SELECT id, name, status
                FROM product_categories
                WHERE status = :status
                ORDER BY name";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $resultSet = $pdo->prepare($sql);
        $resultSet->execute([':status' => $status]);
        
        foreach ($resultSet as $row) {
            $productCategory = $this->createFromDbRow($row);
            
            if ($productCategory !== null) {
                array_push($result, $productCategory);
            }
        }
        
        // Close the connection
        $pdo = null;
        
        // Return the result
        return $result;   
    }
    
    
    /**
     * Get a product category by it's id
     * 
     * @param int $id
     * 
     * @return ProductCategory|null
     */
    public function getById(int $id):?ProductCategory 
    {
        $productCategory = null;
        
        // Generate the query
        $sql = "SELECT id, name, status
                FROM product_categories
                WHERE id = :id";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        // Get the information of the product category
        if ($stmt->rowCount() > 0) {
            $row             = $stmt->fetch(PDO::FETCH_ASSOC);
            $productCategory = $this->createFromDbRow($row);
        }
        
        // Close the db connection
        $pdo = null;
        
        return $productCategory;      
    }
    
    /**
     * Get the information of the product category
     * 
     * @param string $name
     * 
     * @return ProductCategory|null
     */
    public function getByName(string $name):?ProductCategory 
    {
        $productCategory = null;
        
        // Generate the query
        $sql = "SELECT id, name, status
                FROM product_categories 
                WHERE name = :name";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name' => $name]);
        
        // Get the information of the product category
        if ($stmt->rowCount() > 0) {
            $row             = $stmt->fetch(PDO::FETCH_ASSOC);
            $productCategory = $this->createFromDbRow($row);
        }
        
        // Close the db connection
        $pdo = null;
        
        return $productCategory;
    }
    
    /**
     * Insert a new product category
     * 
     * @param ProductCategory $productCategory
     * 
     * @return ProductCategory
     */
    public function insert(ProductCategory $productCategory):ProductCategory 
    {
        // Generate the query
        $sql = "INSERT INTO product_categories(name, status)
                VALUES (:name, :status)";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'   => $productCategory->getName(),
            ':status' => $productCategory->getStatus()
        ]);
        
        // Update the id of the product category
        $productCategoryId = $pdo->lastInsertId();
        $productCategory->setId(intVal($productCategoryId));
        
        // Close the connection
        $pdo = null;
        
        // Return the product category
        return $productCategory;
    }
    
    /**
     * Update an existing product category 
     * 
     * @param ProductCategory $productCategory
     * 
     * @return void
     */
    public function update(ProductCategory $productCategory):void 
    {
        // Generate the query
        $sql = "UPDATE product_categories
                SET name = :name,
                    status = :status
                WHERE id = :id";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'   => $productCategory->getName(),
            ':status' => $productCategory->getStatus(),
            ':id'     => $productCategory->getId()
        ]);
        
        // Close the connection
        $pdo = null;  
    }
    
    /**
     * Delete an existing product category
     * 
     * @param int $id
     * 
     * @return void
     */
    public function delete(int $id):void
    {
        // Generate the query
        $sql = "DELETE 
                FROM product_categories
                WHERE id = :id";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        // Close the connection 
        $pdo = null;
    }
    
    /**
     * Create a product category from a database row
     * 
     * @param array $row
     * 
     * @return ProductCategory|null
     */
    private function createFromDbRow(array $row):?ProductCategory
    {
        $productCategory = null;
        
        if (
            array_key_exists('id', $row)
            && array_key_exists('name', $row)
            && array_key_exists('status', $row)
        ) {
            $productCategory = ProductCategory::map(
                intVal($row['id']),
                $row['name'],
                $row['status']
            );
        }
        
        return $productCategory;
    }
       
}
