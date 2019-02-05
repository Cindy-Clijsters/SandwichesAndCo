<?php

$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, FlashService, ToppingService, TwigService};
use App\Entities\Topping;

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the information to display the view
$toppingId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($toppingId === false || $toppingId === null) {
    header("location:topping.php");
    exit(0);
}

$toppingSvc = new ToppingService();
$topping    = $toppingSvc->getById($toppingId);

if ($topping === null) {
    header("location:topping.php");
    exit(0);
}

// Get the posted values
$tmpTopping = new stdClass();
$tmpTopping->id     = $toppingId;
$tmpTopping->name   = filter_input(INPUT_POST, 'name') ?? $topping->getName();
$tmpTopping->status = filter_input(INPUT_POST, 'status') ?? $topping->getStatus();

// Check if the form is posted
$errors = new stdClass();

if ($_POST) {
    
    $errors = $toppingSvc->validateTopping($tmpTopping);
    
    if ($errors->isValid === true) {
        
        // Update the topping
        $topping->setName($tmpTopping->name)
                ->setStatus($tmpTopping->status);
        
        // Update the information in the database
        $toppingSvc->update($topping);
        
        // Set the success message
        $flashSvc = new FlashService();
        $flashSvc->setFlashMessage(
            "topping",
            "De topping is met succes gewijzigd.",
            "success"
        );
        
        // Redirect to the overview
        header("location:topping.php");
        exit(0);

    }
    
}

// Display the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'toppingCrud.php',
    [
        'menuItem'        => 'topping',
        'companyName'     => $_SESSION['companyName'],
        'administrator'   => $administrator,
        'title'           => "Een topping wijzigen",
        'buttonText'      => "Wijzigen",
        'toppingStatuses' => Topping::getAllStatuses(),
        'tmpTopping'      => $tmpTopping,
        'errors'          => $errors
    ]
);
