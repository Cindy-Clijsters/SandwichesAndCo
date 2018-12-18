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

//Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'profile.php',
    [
        "menuItem"      => "profile",
        "companyName"   => $_SESSION['companyName'],
        "administrator" => $administrator
    ]
);
