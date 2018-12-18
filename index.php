<?php
$root = dirname(__FILE__, 1);

require_once($root . '/vendor/autoload.php');
        
use App\Business\CompanyService;
	
// Get the information to display the view
$companySvc = new CompanyService();
$company    = $companySvc->getInfo();

// Show the view
$twigLoader = new Twig_Loader_Filesystem($root . '/presentation');
$twig       = new Twig_Environment($twigLoader);

echo $twig->render(
    "index.php",
    [
        "company" => $company
    ]
);