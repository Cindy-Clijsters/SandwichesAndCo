<?php
declare(strict_types = 1);

namespace App\Business;

use App\Data\ProductDAO;
use App\Entities\Product;

use stdClass;


class ProductService
{
    /**
     * Get an array with all products
     * 
     * @return array
     */
    public function getAll():array
    {
        $productDAO = new ProductDAO();
        $products   = $productDAO->getAll();
        
        return $products;
    }
    
    /**
     * Get a product by it's name
     * 
     * @param string $name
     * 
     * @return Product|null
     */
    public function getByName(string $name): ?Product
    {
        $productDAO = new ProductDAO();
        $product    = $productDAO->getByName($name);
        
        return $product;
    }
    
    /**
     * Get a product by it's id
     * 
     * @param int $id
     * 
     * @return Product|null
     */
    public function getById(int $id): ?Product 
    {
        $productDAO = new ProductDAO();
        $product    = $productDAO->getById($id);
        
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
     * @return int|null
     */
    public function insert(
        int $productCategoryId,
        string $name,
        float $price,
        string $status
    ) :int {
    
        $productDAO = new ProductDAO();
        $productId  = $productDAO->insert($productCategoryId, $name, $price, $status);
        
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
    public function addTopping(int $productId, int $toppingId) :void
    {
        $productDAO = new ProductDAO();
        $productDAO->addTopping($productId, $toppingId);
    }
    
    /**
     * Validate the product
     * 
     * @param stdClass $tmpProduct
     * 
     * @return stdClass
     */
    public function validateProduct(stdClass $tmpProduct): stdClass 
    {
        $validationSvc = new ValidationService();
        
        $errors          = new stdClass();
        $errors->isValid = true;
        
        $productCategoryErrors = $validationSvc->checkRequired($tmpProduct->productCategory);
       
        if ($productCategoryErrors === '') {
            $productCategoryErrors = $validationSvc->checkValidProductCategory(intVal($tmpProduct->productCategory));
        }
        
        if ($productCategoryErrors !== '') {
            $errors->productCategory = $productCategoryErrors;
            $errors->isValid         = false;
        }
        
        $nameErrors = $validationSvc->validateTextField($tmpProduct->name, 100);
        
        if ($nameErrors === '') {
            $nameErrors = $validationSvc->checkUniqueProductName($tmpProduct->name, $tmpProduct->id);
        }
        
        if ($nameErrors !== '') {
            $errors->name    = $nameErrors;
            $errors->isValid = false;
        }
        
        $priceErrors = $validationSvc->checkRequired($tmpProduct->price);
        
        if ($priceErrors === '') {
            $priceErrors = $validationSvc->checkNumeric($tmpProduct->price);
        }
        
        if ($priceErrors === '') {
            $priceErrors = $validationSvc->checkBiggerThenZero($tmpProduct->price);
        }
        
        if ($priceErrors !== '') {
            $errors->price   = $priceErrors;
            $errors->isValid = false;
        }
        
        $toppingsErrors = '';
        
        if ($tmpProduct->toppings === '') {
            $toppingsErrors = 'Dit is een verplicht veld.';
        }
        
        if ($toppingsErrors === '') {
            
            $toppingSvc       = new ToppingService();
            $activeToppingIds = $toppingSvc->getActiveToppingIds();
            
            foreach ($tmpProduct->toppings as $toppingId) {
                if (!in_array($toppingId, $activeToppingIds)) {
                    $toppingsErrors = 'Dit veld bevat een ongeldige topping.';
                    break;
                }
            }
        }
        
        if ($toppingsErrors !== '') {
            $errors->toppings = $toppingsErrors;
            $errors->isValid  = false;
        }
        
        $statusErrors = $validationSvc->validateTextField($tmpProduct->status, 20);
        
        if ($statusErrors === '') {
            $statusErrors = $validationSvc->checkInArray(
                $tmpProduct->status,
                Product::getAllStatuses(),
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