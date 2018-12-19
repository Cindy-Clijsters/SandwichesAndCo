<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, TwigService, ValidationService};

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService;
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    session_destroy();

    header("location:login.php");
    exit(0);
}

// Initialize view variables
$message = "";

$errors          = new stdClass();
$errors->isValid = true;

// Check if there is at least one administrator left after deleting the user
$amount = $administratorSvc->getAmountAdministrators();

if ($amount <= 1) {
    
    $message  = "<p>Het is niet mogelijk om je account te verwijderen.<br>";
    $message .= "Er moet minstens één administator aanwezig zijn.</p>";
    
}

// Check if the form is posted
if ($_POST) {
    
    $password = filter_input(INPUT_POST, 'password');
    
    // Validate the fields
    $validationSvc = new ValidationService();
    
    $passwordErrors = $validationSvc->validateTextField($password, 50);
    
    if ($passwordErrors !== '') {
        $errors->password = $passwordErrors;
        $errors->isValid  = false;
    }
    
    if ($errors->isValid === true) {
        
        if (password_verify($password, $administrator->getPassword())) {
            
            // Delete the user
            $administratorSvc->delete($administrator);
            
            // Logout
            session_destroy();

            header("location:login.php");
            exit(0);
            
        } else {
            
            $errors->password = "Foutief wachtwoord";
            
        }
    }
}

// Show the view
$twigSrc = new TwigService();

echo $twigSrc->generateView(
    $root . "/admin/presentation",
    "profileDelete.php",
    [
        "menuItem"      => "profile",
        "companyName"   => $_SESSION['companyName'],
        "administrator" => $administrator,
        "message"       => $message,
        "errors"        => $errors
    ]
);
