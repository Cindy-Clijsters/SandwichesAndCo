<?php
declare(strict_types = 1);

namespace App\Business;

use App\Twig\{AdministratorTwigExtension, ProductCategoryExtension, SocialMediaLinkExtension, ToppingExtension};

use Twig_Loader_Filesystem;
use Twig_Environment;

class TwigService
{
    /**
     * Generate the view
     * 
     * @param string $path
     * @param string $file
     * @param array $params
     * 
     * return string
     */
    public function generateView(string $path, string $file, array $params = [])
    {
        $twigLoader = new Twig_Loader_Filesystem($path);
        $twig       = new Twig_Environment($twigLoader);
        
        $twig->addExtension(new AdministratorTwigExtension());
        $twig->addExtension(new ProductCategoryExtension());
        $twig->addExtension(new SocialMediaLinkExtension());
        $twig->addExtension(new ToppingExtension());

        return $twig->render($file, $params);
    }
}
