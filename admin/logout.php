<?php
$root = dirname(__FILE__, 2);

require_once($root . '/vendor/autoload.php');

use App\Business\AdministratorService;

// Logout
$administratorSvc = new AdministratorService();
$administratorSvc->logOut();