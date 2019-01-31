<?php

$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, FlashService, SocialMediaLinkService, TwigService};
use App\Entities\SocialMediaLink;

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the posted values
$tmpLink              = new stdClass();
$tmpLink->id          = null;
$tmpLink->identifier  = filter_input(INPUT_POST, 'identifier') ?? '';
$tmpLink->url         = filter_input(INPUT_POST, 'url') ?? '';
$tmpLink->status      = filter_input(INPUT_POST, 'status') ?? '';

// Check if the form is posted
$errors = new stdClass();
$errors->isValid = true;

$successMessage = "";

if ($_POST) {
    
    $socialMediaLinkSvc = new SocialMediaLinkService();
    $errors             = $socialMediaLinkSvc->validateSocialMediaLink($tmpLink);
    
    if ($errors->isValid === true) {
        
        $socialMediaLink = new SocialMediaLink(
            $tmpLink->identifier,
            $tmpLink->url,
            $tmpLink->status
        );
        
        // Save the social media link
        $socialMediaLinkSvc->insert($socialMediaLink);
        
        // Set the success message
        $flashSvc = new FlashService();
        $flashSvc->setFlashMessage(
            'socialMediaLink',
            'De sociale media link is met succes toegevoegd',
            'success'
        );

        header("location:companyProfile.php");
        exit(0);
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
        'socialMediaLinkIdentifiers' => SocialMediaLink::getAllIdentifiers(),
        'socialMediaLinkStatuses'    => SocialMediaLink::getAllStatuses(),
        'tmpLink'                    => $tmpLink,
        'errors'                     => $errors,
        'successMessage'             => $successMessage
    ]
);