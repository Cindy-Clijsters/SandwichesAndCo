<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, FlashService, SocialMediaLinkService};

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the id of the social media link
$socialMediaLinkId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$socialMediaLink   = null;

if ($socialMediaLinkId !== false && $socialMediaLinkId !== null) {
    
    //var_dump('test');
    $socialMediaLinkSvc = new SocialMediaLinkService();
    $socialMediaLink    = $socialMediaLinkSvc->getById($socialMediaLinkId);
}

if ($socialMediaLink !== null) {
    
    // Delete the link
    $socialMediaLinkSvc->delete($socialMediaLinkId);
    
    // Set the delete message
    $flashSvc = new FlashService();
    $flashSvc->setFlashMessage(
        'socialMediaLink',
        'De sociale media link is met succes verwijderd.',
        'warning'
    );
    
} else {
    
    // Set the error message
    $flashSvc = new FlashService();
    $flashSvc->setFlashMessage(
        'socialMediaLink',
        'Er is een fout opgetreden! De sociale media link is niet verwijderd.',
        'danger'
    );
    
}

header("location:companyProfile.php#social-media-links");
exit(0);