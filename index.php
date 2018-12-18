<?php
$root = dirname(__FILE__, 1);

require_once($root . '/vendor/autoload.php');
        
// Show the view
$twigLoader = new Twig_Loader_Filesystem($root . '/presentation');
$twig       = new Twig_Environment($twigLoader);

echo $twig->render(
    "index.php"       
);