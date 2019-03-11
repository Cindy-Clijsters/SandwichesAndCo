<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, ProductService, TwigService};
use App\Entities\Product;

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the information to display the view
$productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($productId === false || $productId === null) {
    header("location:product.php");
    exit(0);
}

$productSvc = new ProductService();
$product    = $productSvc->getById($productId);

// Display the view
$twigService = new TwigService();

echo $twigService->generateView(
    $root . '/admin/presentation',
    'productDetail.php',
    [
        'menuItem'      => 'product',
        'companyName'   => $_SESSION['companyName'],
        'administrator' => $administrator,
        'title'         => 'Een product bekijken'
    ]
);
