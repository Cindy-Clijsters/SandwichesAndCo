<?php
declare(strict_types = 1);

namespace App\Twig;

$root = dirname(__FILE__, 3);

require_once($root . '/vendor/autoload.php');

use App\Entities\Product;
use Twig_Extension;
use Twig_Function;

class ProductExtension extends Twig_Extension 
{
    /**
     * Get the new functions
     * 
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_Function('translateProductStatus', function(string $status) {
                return $this->translateProductStatus($status);
            })
        ];
    }
    
    /**
     * Translate the status of a product
     * 
     * @param string $status
     * 
     * @return string
     */
    private function translateProductStatus(string $status):string
    {
        switch($status) {
            case Product::STATUS_ACTIVE:
                $translation = 'Actief';
                break;
            case Product::STATUS_INACTIVE:
                $translation = 'Inactief';
                break;
            default:
                $translation = '';
        }
        
        return $translation;
    }
}