<?php

$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, FlashService, ProductCategoryService, TwigService};
use App\Entities\ProductCategory;

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the information to display the view
$productCategoryId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($productCategoryId === false || $productCategoryId === null) {
    header("location:productCategory.php");
    exit(0);
}

$productCategorySvc = new ProductCategoryService();
$productCategory    = $productCategorySvc->getById($productCategoryId);

if ($productCategory === null) {
    header("location:productCategory.php");
    exit(0);
}

// Get the posted values
$tmpProductCategory         = new stdClass();
$tmpProductCategory->id     = $productCategoryId;
$tmpProductCategory->name   = filter_input(INPUT_POST, 'name') ?? $productCategory->getName();
$tmpProductCategory->status = filter_input(INPUT_POST, 'status') ?? $productCategory->getStatus();

// Check if the form is posted
$errors = new stdClass();

if ($_POST) {
    
    $errors = $productCategorySvc->validateProductCategory($tmpProductCategory);
    
    if ($errors->isValid === true) {
        
        // Update the product category
        $productCategory->setName($tmpProductCategory->name)
                        ->setStatus($tmpProductCategory->status);
        
        // Update the information in the database
        $productCategorySvc->update($productCategory);
        
        // Set the success message
        $flashSvc = new FlashService();
        $flashSvc->setFlashMessage(
            'productCategory',
            'De categorie is met succes gewijzigd.',
            'success'
        );

        // Redirect to the overview
        header("location:productCategory.php");
        exit(0);
    }
    
}

// Display the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'productCategoryCrud.php',
    [
        'menuItem'                => 'productCategory',
        'companyName'             => $_SESSION['companyName'],
        'administrator'           => $administrator,
        'title'                   => "Een categorie wijzigen",
        'buttonText'              => "Wijzigen",
        'productCategoryStatuses' => ProductCategory::getAllStatuses(),
        'tmpProductCategory'      => $tmpProductCategory,
        'errors'                  => $errors
    ]
);
