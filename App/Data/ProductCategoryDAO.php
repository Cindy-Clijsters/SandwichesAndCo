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
            array_key_exists('name', $row)
            && array_key_exists('status', $row)
        ) {
            $productCategory = new ProductCategory(
                $row['name'],
                $row['status']
            );
            
            if (array_key_exists('id', $row)) {
                $productCategory->setId(intVal($row['id']));
            }
        }
        
        return $productCategory;
    }
       
}
