<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, ProductCategoryService, TwigService};
use App\Entities\ProductCategory;

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the posted values
$tmpProductCategory         = new stdClass();
$tmpProductCategory->id     = null;
$tmpProductCategory->name   = filter_input(INPUT_POST, 'name') ?? '';
$tmpProductCategory->status = filter_input(INPUT_POST, 'status') ?? '';

// Check if the form is posted
$errors = new stdClass();
$errors->isValid = true;

$successMessage = "";

if ($_POST) {
    
    $productCategorySvc = new ProductCategoryService();
    $errors             = $productCategorySvc->validateProductCategory($tmpProductCategory);
    
    if ($errors->isValid === true) {
        
        $productCategory = new ProductCategory(
            $tmpProductCategory->name,
            $tmpProductCategory->status
        );
        
        // Save the product category
        $productCategorySvc->insert($productCategory);
        
        // Set the success message
        $successMessage = "De categorie is met succes toegevoegd.";
        
    }
    
}

// Display the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'productCategoryCrud.php',
    [
        'menuItem'                => 'topping',
        'companyName'             => $_SESSION['companyName'],
        'administrator'           => $administrator,
        'title'                   => 'Een categorie toevoegen',
        'buttonText'              => 'Toevoegen',
        'productCategoryStatuses' => ProductCategory::STATUSES,
        'tmpProductCategory'      => $tmpProductCategory,
        'errors'                  => $errors,
        'successMessage'          => $successMessage
    ]
);