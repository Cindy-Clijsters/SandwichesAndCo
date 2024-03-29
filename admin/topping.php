<?php

$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, FlashService, ToppingService, TwigService};

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the information to display the view
$toppingSvc = new ToppingService();
$toppings   = $toppingSvc->getAll();

$flashSvc = new FlashService();
list($toppingMsg, $toppingMsgType)   = $flashSvc->getFlashMessage("topping");

// Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'topping.php',
    [
        "menuItem"       => "topping",
        "companyName"    => $_SESSION['companyName'],
        "administrator"  => $administrator,
        "toppings"       => $toppings,
        "toppingMsg"     => $toppingMsg,
        "toppingMsgType" => $toppingMsgType
    ]
);