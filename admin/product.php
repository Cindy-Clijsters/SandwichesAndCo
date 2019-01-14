<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, ProductService, TwigService};

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the information to display the view
$productService = new ProductService();
$products       = $productService->getAll();

// Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'product.php',
    [
        "menuItem"      => "product",
        "companyName"   => $_SESSION['companyName'],
        "administrator" => $administrator,
        "products"      => $products
    ]
);