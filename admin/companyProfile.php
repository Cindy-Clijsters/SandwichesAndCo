<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, CompanyService, FlashService, SocialMediaLinkService, TwigService};

// Check if administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logOut();
}

// Get the information to display the view
$companySvc = new CompanyService();
$company    = $companySvc->getInfo();

$flashSvc = new FlashService();
list($companyProfileMsg, $companyProfileMsgType)   = $flashSvc->getFlashMessage("companyProfile");

$socialMediaLinkSvc = new SocialMediaLinkService();
$socialMediaLinks   = $socialMediaLinkSvc->getAll();

list($socialMediaLinkMsg, $socialMediaLinkMsgType) = $flashSvc->getFlashMessage("socialMediaLink");

//Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'companyProfile.php',
    [
        "menuItem"               => "companyProfile",
        "companyName"            => $_SESSION['companyName'],
        "administrator"          => $administrator,
        "company"                => $company,
        "companyProfileMsg"      => $companyProfileMsg,
        "companyProfileMsgType"  => $companyProfileMsgType,
        "socialMediaLinks"       => $socialMediaLinks,
        "socialMediaLinkMsg"     => $socialMediaLinkMsg,
        "socialMediaLinkMsgType" => $socialMediaLinkMsgType
    ]
);
