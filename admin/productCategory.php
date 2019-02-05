<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, FlashService, ProductCategoryService, TwigService};

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the information to display the view
$productCategorySvc = new ProductCategoryService();
$productCategories  = $productCategorySvc->getAll();

$flashSvc = new FlashService();
list($productCategoryMsg, $productCategoryMsgType) = $flashSvc->getFlashMessage("productCategory");

// Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'productCategory.php',
     [
         "menuItem"               => 'productCategory',
         "companyName"            => $_SESSION['companyName'],
         "administrator"          => $administrator,
         "productCategories"      => $productCategories,
         "productCategoryMsg"     => $productCategoryMsg,
         "productCategoryMsgType" => $productCategoryMsgType
     ]
);
