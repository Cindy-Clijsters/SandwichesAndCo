<?php
$root = dirname(__FILE__, 1);

require_once($root . '/vendor/autoload.php');
        
use App\Business\CompanyService;
use App\Business\TwigService;
	
// Get the information to display the view
$companySvc = new CompanyService();
$company    = $companySvc->getInfo();

// Show the view
$twigSvc = new TwigService();

echo $twigSvc->generateView(
    $root . '/presentation',
    'index.php',
    [
        "company" => $company
    ] 
);
