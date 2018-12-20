<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, CompanyService, TwigService};

// Check if administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the information to display the view
$companySvc = new CompanyService();
$company    = $companySvc->getInfo();

// Get the posted values
$tmpCompany             = new stdClass();
$tmpCompany->name       = filter_input(INPUT_POST, 'name') ?? $company->getName();
$tmpCompany->address    = filter_input(INPUT_POST, 'address') ?? $company->getAddress();
$tmpCompany->postalCode = filter_input(INPUT_POST, 'postal-code') ?? $company->getPostalCode();
$tmpCompany->city       = filter_input(INPUT_POST, 'city') ?? $company->getCity();
$tmpCompany->telephone  = filter_input(INPUT_POST, 'telephone') ?? $company->getTelephone();
$tmpCompany->email      = filter_input(INPUT_POST, 'email') ?? $company->getEmail();
$tmpCompany->vatNumber  = filter_input(INPUT_POST, 'vat-number') ?? $company->getVatNumber();

// Display the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'companyProfileEdit.php',
    [
        'companyName'   => $_SESSION['companyName'],
        'administrator' => $administrator,
        'tmpCompany'    => $tmpCompany
    ]
);