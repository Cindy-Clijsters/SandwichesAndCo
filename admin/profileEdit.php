<?php

$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\AdministratorService;
use App\Business\TwigService;
use App\Business\ValidationService;
use App\Entities\Administrator;

// Check if the administrator is logged in correctly
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!array_key_exists('adminId', $_SESSION)) {
    
    header("location:login.php");
    exit(0);
    
} else {
    
    // Get the information of the administrator
    $administratorSvc = new AdministratorService();
    $administrator    = $administratorSvc->getById($_SESSION['adminId']);
    
    if (
        ($administrator === null)
        || ($administrator->getStatus() !== Administrator::STATUS_ACTIVE)
    ) {
        session_destroy();
        
        header("location:login.php");
        exit(0);
    }
    
}

// Get the posted values
$firstName = filter_input(INPUT_POST, 'first-name') ?? $administrator->getFirstName();
$lastName  = filter_input(INPUT_POST, 'last-name') ?? $administrator->getLastName();
$email     = filter_input(INPUT_POST, 'email') ?? $administrator->getEmail();

// Check if the form is posted
$errors = new stdClass();
$errors->isValid = true;

$successMessage = "";

if ($_POST) {
    
    // Validate the fields
    $validationSvc = new ValidationService();
    
    $firstNameErrors = $validationSvc->checkRequired($firstName);
    
    if ($firstNameErrors == '') {
        $firstNameErrors = $validationSvc->checkMaxLength($firstName, 50);
    }
    
    if ($firstNameErrors !== '') {
        $errors->firstName = $firstNameErrors;
        $errors->isValid   = false;
    }
    
    $lastNameErrors = $validationSvc->checkRequired($lastName);
    
    if ($lastNameErrors === '') {
        $lastNameErrors = $validationSvc->checkMaxLength($lastName, 50);
    }
    
    if ($lastNameErrors !== '') {
        $errors->lastName = $lastNameErrors;
        $errors->isValid  = false;
    }
    
    $emailErrors = $validationSvc->checkRequired($email);
    
    if ($emailErrors === '') {
        $emailErrors = $validationSvc->checkMaxLength($email, 100);
    }
    
    if ($emailErrors === '') {
        $emailErrors = $validationSvc->checkEmail($email);
    }
    
    if ($emailErrors === '') {
        $emailErrors = $validationSvc->checkUniqueAdministratorMail(
            $email,
            $administrator->getId()
        );
    }
    
    if ($emailErrors !== '') {
        $errors->email   = $emailErrors;
        $errors->isValid = false;
    }
    
    if ($errors->isValid === true) {
        
        // Update the administrator
        $administrator->setFirstName($firstName)
                      ->setLastName($lastName)
                      ->setEmail($email);
        
        // Save the information of the user in the database
        $administratorSvc->update($administrator);
        
        $successMessage = "Je gegevens zijn met succes gewijzigd.";
        
    }
    
}

// Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'profileEdit.php',
    [
        "menuItem"       => "profile",
        "companyName"    => $_SESSION['companyName'],
        "administrator"  => $administrator,
        "firstName"      => $firstName,
        "lastName"       => $lastName,
        "email"          => $email,
        "errors"         => $errors,
        "successMessage" => $successMessage
    ]
);
