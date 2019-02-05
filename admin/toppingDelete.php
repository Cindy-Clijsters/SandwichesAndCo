<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, FlashService, ToppingService};

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the id to the topping
$toppingId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$topping   = null;


if ($toppingId !== false && $toppingId !== null) {
    $toppingSvc = new ToppingService();
    $topping    = $toppingSvc->getById($toppingId);
}

if ($topping !== null) {
    
    $toppingSvc->delete($toppingId);
    
    // Set the delete message
    $flashSvc = new FlashService();
    $flashSvc->setFlashMessage(
        "topping",
        "De topping is met succes verwijderd.",
        "warning"
    );
    
} else {
    
    // Set the error message
    $flashSvc = new FlashService();
    $flashSvc->setFlashMessage(
        'topping',
        'Er is een fout opgetreden! De topping is niet verwijderd.',
        'danger'
    );    
    
}

header("location:topping.php");
exit(0);