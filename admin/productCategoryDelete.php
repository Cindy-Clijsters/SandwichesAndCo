<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, ProductCategoryService};

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the id to the topping
$productCategoryId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($productCategoryId !== false && $productCategoryId !== null) {
    $productCategorySvc = new ProductCategoryService();
    $productCategorySvc->delete($productCategoryId);
}

header("location:productCategory.php");
exit(0);

