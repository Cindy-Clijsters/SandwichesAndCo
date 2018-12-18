<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (array_key_exists('adminId', $_SESSION)) {
    header("location:dashboard.php");  
    exit(0);
}

$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\AdministratorService;
use App\Business\CompanyService;
use App\Business\TwigService;
use App\Business\ValidationService;
use App\Entities\Administrator;

// Get the information to display the view
$companySvc = new CompanyService();
$company    = $companySvc->getInfo();

$errors          = new stdClass();
$errors->isValid = true;

// Get the posted values
$email    = filter_input(INPUT_POST, 'email') ?? '';
$password = filter_input(INPUT_POST, 'password') ?? '';

// Check if the form is posted
if ($_POST) {
    
    $validationSvc = new ValidationService();
    
    $emailErrors = $validationSvc->checkRequired($email);
    
    if ($emailErrors === '') {
        $emailErrors = $validationSvc->checkMaxLength($email, 100);
    }
    
    if ($emailErrors === '') {
        $emailErrors = $validationSvc->checkEmail($email);
    }
    
    if ($emailErrors !== '') {
        $errors->email   = $emailErrors;
        $errors->isValid = false;
    }
    
    $passwordErrors = $validationSvc->checkRequired($password);
    
    if ($passwordErrors === '') {
        $passwordErrors = $validationSvc->checkMaxLength($password, 50);
    }
    
    if ($passwordErrors !== '') {
        $errors->password = $passwordErrors;
        $errors->isValid  = false;
    }
    
    if ($errors->isValid === true) {

        // Get the information of the administrator
        $administratorSvc = new AdministratorService();
        $administrator    = $administratorSvc->getByEmail($email);
        
        if (
            ($administrator !== null)
            && ($administrator->getStatus() === Administrator::STATUS_ACTIVE)
            && (password_verify($password, $administrator->getPassword()))
        ) {
                    
            $_SESSION['adminId']     = $administrator->getId();
            $_SESSION['companyName'] = $company->getName();

            header("location:dashboard.php");
            exit(0);
                    
        } else {
            
            $errors->password ="Foutief e-mailadres of wachtwoord.";
            
        }   
    }
}

// Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'login.php',
    [
        "company" => $company,
        "errors"  => $errors
    ]  
);
