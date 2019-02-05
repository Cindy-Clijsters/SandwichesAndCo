<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, FlashService, ProductCategoryService};

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the id to the topping
$productCategoryId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$productCategory   = null;

if ($productCategoryId !== false && $productCategoryId !== null) {
    $productCategorySvc = new ProductCategoryService();
    $productCategory    = $productCategorySvc->getById($productCategoryId);
}

if ($productCategory !== null) {
    
    // Delete the link
    $productCategorySvc->delete($productCategoryId);
    
    // Set the delete message
    $flashSvc = new FlashService();
    $flashSvc->setFlashMessage(
        'productCategory',
        'De product categorie is met succes verwijderd.',
        'warning'
    );
    
} else {
    
    // Set the error message
    $flashSvc = new FlashService();
    $flashSvc->setFlashMessage(
        'productCategory',
        'Er is een fout opgetreden! De product categorie is niet verwijderd.',
        'danger'
    );
    
}

header("location:productCategory.php");
exit(0);

