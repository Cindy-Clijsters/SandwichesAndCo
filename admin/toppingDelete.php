<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, ToppingService};

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the id to the topping
$toppingId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($toppingId !== false && $toppingId !== null) {
    $toppingSvc = new ToppingService();
    $toppingSvc->delete($toppingId);
}

header("location:topping.php");
exit(0);