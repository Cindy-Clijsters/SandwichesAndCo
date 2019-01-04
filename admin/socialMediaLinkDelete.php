<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, SocialMediaLinkService};

// Check if the administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logout();
}

// Get the id of the social media link
$socialMediaLinkId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($socialMediaLinkId !== false) {
    $socialMediaLinkSvc = new SocialMediaLinkService();
    $socialMediaLinkSvc->delete($socialMediaLinkId);
}

header("location:companyProfile.php");
exit(0);