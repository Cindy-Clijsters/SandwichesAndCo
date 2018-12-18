<?php
declare(strict_types = 1);

namespace App\Twig;

$root = dirname(__FILE__, 3);

require_once($root . '/vendor/autoload.php');

use App\Entities\Administrator;
use Twig_Extension;
use Twig_Function;

class ProjectTwigExtension extends Twig_Extension
{
    /**
     * Get the new functions
     * 
     * @return array
     */    
    public function getFunctions()
    {
        return [
            new Twig_Function('translateAdministratorStatus', function(string $status) {
                return $this->translateAdministratorStatus($status);
            })
        ];
    }
    
    /**
     * Translate the status of the administrator
     * 
     * @param string $status
     * 
     * @return string
     */
    private function translateAdministratorStatus(string $status):string
    {
        switch ($status) {
            case Administrator::STATUS_ACTIVE:
                $translation = 'Actief';
                break;
            default:
                $translation = '';
        }
        
        return $translation;
    }
}
