<?php
declare(strict_types = 1);

namespace App\Business;

use App\Data\ProductCategoryDAO;
use App\Entities\ProductCategory;

use stdClass;

class ProductCategoryService
{
    /**
     * Get an array with all product categories
     * 
     * @return array
     */
    public function getAll():array
    {
        $productCategoryDAO = new ProductCategoryDAO();
        $productCategories  = $productCategoryDAO->getAll();
        
        return $productCategories;
    }
    
    /**
     * Get a product category by it's name
     * 
     * @param string $name
     * 
     * @return ProductCategory|null
     */
    public function getByName(string $name):?ProductCategory
    {
        $productCategoryDAO = new ProductCategoryDAO();
        $productCategory    = $productCategoryDAO->getByName($name);
        
        return $productCategory;
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
        $productCategoryDAO = new ProductCategoryDAO();
        $productCategory    = $productCategoryDAO->getById($id);
        
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
        $productCategoryDAO = new ProductCategoryDAO();
        $newProductCategory = $productCategoryDAO->insert($productCategory);
        
        return $newProductCategory;
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
        $productCategoryDAO = new ProductCategoryDAO();
        $productCategoryDAO->update($productCategory);
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
        $productCategoryDAO = new ProductCategoryDAO();
        $productCategoryDAO->delete($id);
    }
    
    /**
     * Validate the product category
     * 
     * @param stdClass $tmpProductCategory
     * 
     * @return stdClass
     */
    public function validateProductCategory(stdClass $tmpProductCategory):stdClass 
    {
        $validationSvc = new ValidationService();
        
        $errors          = new stdClass();
        $errors->isValid = true;
        
        $nameErrors = $validationSvc->validateTextField($tmpProductCategory->name, 100);
        
        if ($nameErrors === '') {
            $nameErrors = $validationSvc->checkUniqueProductCategoryName(
                $tmpProductCategory->name,
                $tmpProductCategory->id
            );
        }
        
        if ($nameErrors !== '') {
            $errors->name    = $nameErrors;
            $errors->isValid = false;
        }
        
        $statusErrors = $validationSvc->validateTextField($tmpProductCategory->status, 20);
        
        if ($statusErrors === '') {
            $statusErrors = $validationSvc->checkInArray(
                $tmpProductCategory->status,
                ProductCategory::STATUSES,
                'status'   
            );
        }
        
        if ($statusErrors !== '') {
            $errors->status  = $statusErrors;
            $errors->isValid = false;
        }
        
        return $errors;
    }
}