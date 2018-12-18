<?php

$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\AdministratorService;
use App\Business\TwigService;
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

// Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'profileEdit.php',
    [
        "menuItem"      => "profile",
        "companyName"   => $_SESSION['companyName'],
        "administrator" => $administrator,
        "firstName"     => $firstName,
        "lastName"      => $lastName,
        "email"         => $email
    ]
);
