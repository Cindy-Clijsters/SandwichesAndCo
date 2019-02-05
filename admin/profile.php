<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\{AdministratorService, FlashService, TwigService};

// Check if administrator is logged in correctly
$administratorSvc = new AdministratorService();
$administrator    = $administratorSvc->getLoggedInAdministrator();

if ($administrator === null) {
    $administratorSvc->logOut();
}

$flashSvc = new FlashService();
list($profileMsg, $profileMsgType) = $flashSvc->getFlashMessage('profile');

//Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/admin/presentation',
    'profile.php',
    [
        "menuItem"       => "profile",
        "companyName"    => $_SESSION['companyName'],
        "administrator"  => $administrator,
        "profileMsg"     => $profileMsg,
        "profileMsgType" => $profileMsgType
    ]
);
