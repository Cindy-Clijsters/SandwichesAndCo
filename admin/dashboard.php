<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, TwigService};

// Check if administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    session_destroy();

    header("location:login.php");
    exit(0);
}

// Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'dashboard.php',
    [
        "menuItem"       => "dashboard",
        "companyName"    => $_SESSION['companyName'],
        "administrator"  => $administrator
    ]  
);
