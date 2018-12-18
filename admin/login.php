<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\CompanyService;
use App\Business\ValidationService;

// Get the information to display the view
$companySvc = new CompanyService();
$company    = $companySvc->getInfo();

// Get the posted values
$email    = filter_input(INPUT_POST, 'email') ?? '';
$password = filter_input(INPUT_POST, 'password') ?? '';

// Check if the form is posted
if ($_POST) {
    
    $errors          = new stdClass();
    $errors->isValid = true;
    
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
    
}

// Show the view
$twigLoader = new Twig_Loader_Filesystem($root . '/admin/presentation');
$twig       = new Twig_Environment($twigLoader);

echo $twig->render(
    "login.php",
    [
        "company" => $company,
        "errors"  => $errors
    ]        
);
