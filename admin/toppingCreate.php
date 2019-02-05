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

// Get the posted values
$tmpTopping         = new stdClass();
$tmpTopping->id     = null;
$tmpTopping->name   = filter_input(INPUT_POST, 'name') ?? '';
$tmpTopping->status = filter_input(INPUT_POST, 'status') ?? '';

// Check if the form is posted
$errors = new stdClass();
$errors->isValid = true;

if ($_POST) {
    
    $toppingSvc = new ToppingService();
    $errors     = $toppingSvc->validateTopping($tmpTopping);
    
    if ($errors->isValid === true) {
        
        $topping = new Topping(
            $tmpTopping->name,
            $tmpTopping->status
        );
        
        // Save the topping link
        $toppingSvc->insert($topping);
        
        // Set the success message 
        $flashSvc = new FlashService();
        $flashSvc->setFlashMessage(
            "topping",
            "De topping is met success toegevoegd.",
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
        'title'           => "Een topping toevoegen",
        'buttonText'      => "Toevoegen",
        'toppingStatuses' => Topping::getAllStatuses(),
        'tmpTopping'      => $tmpTopping,
        'errors'          => $errors
    ]
);