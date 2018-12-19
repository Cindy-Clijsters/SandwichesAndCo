<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, CompanyService, TwigService};

// Check if administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logOut();
}

// Get the information to display the view
$companySvc = new CompanyService();
$company    = $companySvc->getInfo();

//Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'companyProfile.php',
    [
        "menuItem"      => "profile",
        "companyName"   => $_SESSION['companyName'],
        "administrator" => $administrator,
        "company"       => $company
    ]
);
