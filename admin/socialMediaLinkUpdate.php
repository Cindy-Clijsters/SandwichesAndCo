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

// Get the information to display the view
$socialMediaLinkId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($socialMediaLinkId === false || $socialMediaLinkId === null) {
    header("location:companyProfile.php");
    exit(0);
}

$socialMediaLinkSvc = new SocialMediaLinkService();
$socialMediaLink    = $socialMediaLinkSvc->getById($socialMediaLinkId);

if ($socialMediaLink === null) {
    header("location:companyProfile.php");
    exit(0);
}

// Get the posted values
$tmpLink = new stdClass();
$tmpLink->id         = $socialMediaLinkId;
$tmpLink->identifier = filter_input(INPUT_POST, 'identifier') ?? $socialMediaLink->getIdentifier();
$tmpLink->url        = filter_input(INPUT_POST, 'url') ?? $socialMediaLink->getUrl();
$tmpLink->status     = filter_input(INPUT_POST, 'status') ?? $socialMediaLink->getStatus();

// Check if the form is posted
$errors         = new stdClass();
$successMessage = "";

if ($_POST) {
    
    $errors = $socialMediaLinkSvc->validateSocialMediaLink($tmpLink);
    
    if ($errors->isValid === true) {
        
        // Update the social media link
        $socialMediaLink->setIdentifier($tmpLink->identifier)
                        ->setUrl($tmpLink->url)
                        ->setStatus($tmpLink->status);
        
        // Update the information in the database
        $socialMediaLinkSvc->update($socialMediaLink);
        
        // Set the success message
        $successMessage = "De link is met succes gewijzigd.";
        
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
        'title'                      => "Een sociale medialink wijzigen",
        'buttonText'                 => "Wijzigen",
        'socialMediaLinkIdentifiers' => SocialMediaLink::IDENTIFIERS,
        'socialMediaLinkStatuses'    => SocialMediaLink::STATUSES,
        'tmpLink'                    => $tmpLink,
        'errors'                     => $errors,
        'successMessage'             => $successMessage
    ]
);