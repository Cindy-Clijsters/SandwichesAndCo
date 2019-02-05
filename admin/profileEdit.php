<?php

$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, FlashService, TwigService, ValidationService};

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logOut();
}

// Get the posted values
$firstName = filter_input(INPUT_POST, 'first-name') ?? $administrator->getFirstName();
$lastName  = filter_input(INPUT_POST, 'last-name') ?? $administrator->getLastName();
$email     = filter_input(INPUT_POST, 'email') ?? $administrator->getEmail();

// Check if the form is posted
$errors = new stdClass();
$errors->isValid = true;

if ($_POST) {
    
    // Validate the fields
    $validationSvc = new ValidationService();
    
    $firstNameErrors = $validationSvc->validateTextField($firstName, 50);
    
    if ($firstNameErrors !== '') {
        $errors->firstName = $firstNameErrors;
        $errors->isValid   = false;
    }
    
    $lastNameErrors = $validationSvc->validateTextField($lastName, 50);
    
    if ($lastNameErrors !== '') {
        $errors->lastName = $lastNameErrors;
        $errors->isValid  = false;
    }
    
    $emailErrors = $validationSvc->validateEmailField($email, 100);
    
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
        
        // Set the success message
        $flashSvc = new FlashService();
        $flashSvc->setFlashMessage(
            'profile',
            'Je gegevens zijn met succes gewijzigd',
            'success'
        );
        
        // Redirect to the overview
        header("location:profile.php");
        exit(0);
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
        "errors"         => $errors
    ]
);
