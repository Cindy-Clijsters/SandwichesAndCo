<?php
declare(strict_types = 1);

namespace App\Twig;

$root = dirname(__FILE__, 3);

require_once($root . '/vendor/autoload.php');

use App\Entities\ProductCategory;
use Twig_Extension;
use Twig_Function;

class ProductCategoryExtension extends Twig_Extension
{
    /**
     * Get the new functions
     * 
     * @return array
     */
    public function getFunctions() 
    {
        return [
            new Twig_Function('translateProductCategoryStatus', function(string $status) {
                return $this->translateProductCategoryStatus($status);
            })
        ];
    }
    
    /**
     * Translate the status of the product categories
     * 
     * @param string $status
     * 
     * @return string
     */
    private function translateProductCategoryStatus(string $status):string
    {
        switch ($status) {
            case ProductCategory::STATUS_ACTIVE:
                $translation = "Actief";
                break;
            case ProductCategory::STATUS_INACTIVE:
                $translation = "Inactief";
                break;
            default:
                $translation = '';
        }
        
        return $translation;
    }
}
