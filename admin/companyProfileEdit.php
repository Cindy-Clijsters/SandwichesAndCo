<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, CompanyService, TwigService, ValidationService};
use App\Entities\Company;

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

// Check if the form is posted
$errors = new stdClass();
$errors->isValid = true;

$successMessage = "";

if ($_POST) {

    $validationSvc = new ValidationService();
    
    $nameErrors =  $validationSvc->validateTextField($tmpCompany->name, 50);
    
    if ($nameErrors !== '') {
        $errors->name    = $nameErrors;
        $errors->isValid = false;
    }
    
    $addressErrors = $validationSvc->checkMaxLength($tmpCompany->address, 100);
    
    if ($addressErrors !== '') {
        $errors->address = $addressErrors;
        $errors->isValid = false;
    }
    
    $postalCodeErrors = $validationSvc->checkMaxLength($tmpCompany->postalCode, 4);
    
    if ($postalCodeErrors === '') {
        $postalCodeErrors = $validationSvc->checkValidPostalCode($tmpCompany->postalCode);
    }
    
    if ($postalCodeErrors !== '') {
        $errors->postalCode = $postalCodeErrors;
        $errors->isValid    = false;
    }
    
    $cityErrors = $validationSvc->checkMaxLength($tmpCompany->city, 50);
    
    if ($cityErrors !== '') {
        $errors->city    = $cityErrors;
        $errors->isValid = false;
    }
    
    $telephoneErrors = $validationSvc->checkMaxLength($tmpCompany->telephone, 20);
    
    if ($telephoneErrors === '') {
        $telephoneErrors = $validationSvc->checkValidTelephoneNumber($tmpCompany->telephone);
    }
    
    if ($telephoneErrors !== '') {
        $errors->telephone = $telephoneErrors;
        $errors->isValid   = false;
    }
    
    $emailErrors = $validationSvc->validateEmailField($tmpCompany->email, 100);
    
    if ($emailErrors !== '') {
        $errors->email   = $emailErrors;
        $errors->isValid = false;
    }
    
    $vatNumberErrors = $validationSvc->checkMaxLength($tmpCompany->vatNumber, 20);
    
    if ($vatNumberErrors === '') {
        $vatNumberErrors = $validationSvc->checkValidVatNumber($tmpCompany->vatNumber);
    }
    
    if ($vatNumberErrors !== '') {
        $errors->vatNumber = $vatNumberErrors;
        $errors->isValid   = false;
    }
    
    if ($errors->isValid === true) {
        
        // Update the company
        $company->setName($tmpCompany->name)
                ->setAddress($tmpCompany->address)
                ->setPostalCode($tmpCompany->postalCode)
                ->setCity($tmpCompany->city)
                ->setTelephone($tmpCompany->telephone)
                ->setEmail($tmpCompany->email)
                ->setVatNumber($tmpCompany->vatNumber);
        
        // Save the information in db
        $companySvc->update($company);
        
        // Set the success message
        $successMessage = "De bedrijfsgegevens zijn met succes gewijzigd.";
        
        $_SESSION['companyName'] = $tmpCompany->name;
        
    }
}

// Display the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'companyProfileEdit.php',
    [
        'companyName'    => $_SESSION['companyName'],
        'administrator'  => $administrator,
        'tmpCompany'     => $tmpCompany,
        'errors'         => $errors,
        'successMessage' => $successMessage
    ]
);