<?php
declare(strict_types = 1);

namespace App\Twig;

$root = dirname(__FILE__, 3);

require_once($root . '/vendor/autoload.php');

use App\Entities\Topping;
use Twig_Extension;
use Twig_Function;

class ToppingExtension extends Twig_Extension
{
    /**
     * Get the new functions
     * 
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_Function('translateToppingStatus', function(string $status) {
                return $this->translateToppingStatus($status);
            })
        ];
    }
    
    /**
     * Translate the status of the toppings
     * 
     * @param string $status
     * 
     * @return string
     */
    private function translateToppingStatus(string $status):string
    {
        switch($status) {
            case Topping::STATUS_ACTIVE:
                $translation = "Actief";
                break;
            case Topping::STATUS_INACTIVE:
                $translation = "Inactief";
                break;
            default:
                $translation = '';
        }
        
        return $translation;
    }
}