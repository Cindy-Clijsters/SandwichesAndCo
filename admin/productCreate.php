<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, FlashService, ProductService, ProductCategoryService, ToppingService, TwigService};
use App\Entities\Product;

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the posted values
$tmpProduct                  = new stdClass();
$tmpProduct->id              = null;
$tmpProduct->productCategory = filter_input(INPUT_POST, 'productCategory') ?? '';
$tmpProduct->name            = filter_input(INPUT_POST, 'name') ?? '';
$tmpProduct->price           = filter_input(INPUT_POST, 'price') ?? '';
$tmpProduct->toppings        = filter_input(INPUT_POST, 'topping', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?? '';
$tmpProduct->status          = filter_input(INPUT_POST, 'status') ?? '';

var_dump($tmpProduct->toppings);

// Check if the form is posted
$errors = new stdClass();
$errors->isValid = true;

if ($_POST) {

    $productSvc = new ProductService();
    $errors     = $productSvc->validateProduct($tmpProduct);

    if ($errors->isValid === true) {
        
        // Generate a product object        
        $price = str_replace(',', '.', $tmpProduct->price);
        $price = str_replace(' ', '', $price);
        
        // Save the product category
        $productId = $productSvc->insert(
            intVal($tmpProduct->productCategory),
            $tmpProduct->name,
            floatVal($price),
            $tmpProduct->status                
        );
        
        // Save the toppings
        foreach ($tmpProduct->toppings as $toppingId) {
            $productSvc->addTopping($productId, $toppingId);
        }
        
        // Set the success message
        $flashSvc = new FlashService();
        
        $flashSvc->setFlashMessage(
            "product",
            "Het product is met succes toegevoegd.",
            "success"
        );
        
        // Redirect the page
        header("location:product.php");
        exit(0);
    }
    
}

// Display the view 
$productCategorySvc = new ProductCategoryService();
$productCategories  = $productCategorySvc->filterByStatus('active');

$toppingSvc = new ToppingService();
$toppings   = $toppingSvc->filterByStatus('active');

$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'productCrud.php',
    [
        'menuItem'          => 'product',
        'companyName'       => $_SESSION['companyName'],
        'administrator'     => $administrator,
        'title'             => 'Een product toevoegen',
        'buttonText'        => 'Toevoegen',
        'productCategories' => $productCategories,
        'toppings'          => $toppings,
        'productStatuses'   => Product::getAllStatuses(),
        'tmpProduct'        => $tmpProduct,
        'errors'            => $errors
    ]
);
