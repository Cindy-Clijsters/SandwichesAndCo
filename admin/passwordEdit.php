<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, TwigService, ValidationService};

// Check if the admnistrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    session_destroy();
    
    header("location:login.php");
    exit(0);
}

// Check if the form is posted
$errors          = new stdClass();
$errors->isValid = true;

$successMessage = "";

if ($_POST) {
    
    $oldPassword     = filter_input(INPUT_POST, 'old-password');
    $password        = filter_input(INPUT_POST, 'password');
    $confirmPassword = filter_input(INPUT_POST, 'confirm-password');
    
    // Validate the fields
    $validationSvc = new ValidationService();

    $oldPasswordErrors = $validationSvc->checkRequired($oldPassword);
    
    if ($oldPasswordErrors === '') {
        $oldPasswordErrors = $validationSvc->checkMaxLength($oldPassword, 50);
    }
    
    if ($oldPasswordErrors !== '') {
        $errors->oldPassword = $oldPasswordErrors;
        $errors->isValid     = false;
    }
    
    $passwordErrors = $validationSvc->checkRequired($password);
    
    if ($passwordErrors === '') {
        $passwordErrors = $validationSvc->checkMinLength($password, 8);
    }
    
    if ($passwordErrors === '') {
        $passwordErrors = $validationSvc->checkMaxLength($password, 50);
    }
    
    if ($passwordErrors === '') {
        $passwordErrors = $validationSvc->checkSafePassword($password);
    }
    
    if ($passwordErrors !== '') {
        $errors->password = $passwordErrors;
        $errors->isValid  = false;
    }
    
    $confirmPasswordErrors = $validationSvc->checkRequired($confirmPassword);

    if ($confirmPasswordErrors === '') {
        $confirmPasswordErrors = $validationSvc->checkMaxLength($confirmPassword, 50);
    }
    
    if ($passwordErrors === '' && $confirmPasswordErrors === '') {
        $confirmPasswordErrors = $validationSvc->checkConfirmPassword($password, $confirmPassword);
    }

    if ($confirmPasswordErrors !== '') {
        $errors->confirmPassword = $confirmPasswordErrors;
        $errors->isValid  = false;
    }
    
    if ($errors->isValid === true) {

        if (password_verify($oldPassword, $administrator->getPassword())) {
            
            // Hash the password
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            // Update the password
            $administrator->setPassword($passwordHash);
            
            // Update the administrator
            $administratorSvc->update($administrator);
            
            $successMessage = "Je wachtwoord is met success gewijzigd.";
        }
        
    }
    
}

// Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'passwordEdit.php',
    [
        "menuItem"       => "profile",
        "companyName"    => $_SESSION['companyName'],
        "administrator"  => $administrator,
        "errors"         => $errors,
        "successMessage" => $successMessage
    ]
);