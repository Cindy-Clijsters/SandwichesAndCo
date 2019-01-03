<?php

$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, SocialMediaLinkService, TwigService, ValidationService};
use App\Entities\SocialMediaLink;

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the posted values
$tmpLink              = new stdClass();
$tmpLink->identifier  = filter_input(INPUT_POST, 'identifier') ?? '';
$tmpLink->url         = filter_input(INPUT_POST, 'url') ?? '';
$tmpLink->status      = filter_input(INPUT_POST, 'status') ?? '';

// Check if the form is posted
$errors = new stdClass();
$errors->isValid = true;

$successMessage = "";

if ($_POST) {
    
    $validationSvc = new ValidationService();
    
    $identifierErrors = $validationSvc->validateTextField($tmpLink->identifier, 50);
    
    if ($identifierErrors === '') {
        $identifierErrors = $validationSvc->checkUniqueSocialMediaLinkIdentifier($tmpLink->identifier);
    }
    
    if ($identifierErrors !== '') {
        $errors->identifier = $identifierErrors;
        $errors->isValid    = false;
    }
    
    $urlErrors = $validationSvc->validateTextField($tmpLink->url, 255);
    
    if ($urlErrors === '') {
        $urlErrors = $validationSvc->checkUrl($tmpLink->url);
    }
    
    if ($urlErrors !== '') {
        $errors->url     = $urlErrors;
        $errors->isValid = false;
    }
    
    $statusErrors = $validationSvc->validateTextField($tmpLink->status, 20);
    
    if ($statusErrors !== '') {
        $errors->status  = $statusErrors;
        $errors->isValid = false;
    }
    
    if ($errors->isValid === true) {
        
        $socialMediaLink = new SocialMediaLink(
            $tmpLink->identifier,
            $tmpLink->url,
            $tmpLink->status
        );
        
        // Save the social media link
        $socialMediaLinkSvc = new SocialMediaLinkService();
        $socialMediaLinkSvc->insert($socialMediaLink);
        
        // Set the success message
        $successMessage = "De sociale media link is met success toegevoegd.";        
    }
}

// Display the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'socialMediaLinkCrud.php',
    [
        'menuItem'                   => 'companyProfile',
        'companyName'                => $_SESSION['companyName'],
        'administrator'              => $administrator,
        'title'                      => "Een sociale medialink toevoegen",
        'buttonText'                 => "Toevoegen",
        'socialMediaLinkIdentifiers' => SocialMediaLink::IDENTIFIERS,
        'socialMediaLinkStatuses'    => SocialMediaLink::STATUSES,
        'tmpLink'                    => $tmpLink,
        'errors'                     => $errors,
        'successMessage'             => $successMessage
    ]
);