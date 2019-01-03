<?php
declare(strict_types = 1);

namespace App\Twig;

$root = dirname(__FILE__, 3);

require_once($root . '/vendor/autoload.php');

use App\Entities\SocialMediaLink;
use Twig_Extension;
use Twig_Function;

class SocialMediaLinkExtension extends Twig_Extension
{
    /**
     * Get the new functions
     * 
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_Function('translateSocialMediaLinkIdentifier', function(string $identifier) {
                return $this->translateSocialMediaLinkIdentifier($identifier);
            }),
            new Twig_Function('translateSocialMediaLinkStatus', function(string $status) {
                return $this->translateSocialMediaLinkStatus($status);
            })
        ];
    }
    
    /**
     * Translate the identifier of the social media link
     * 
     * @param string $identifier
     * 
     * @return string
     */
    private function translateSocialMediaLinkIdentifier(string $identifier):string
    {
        switch ($identifier) {
            case SocialMediaLink::IDENTIFIER_FACEBOOK:
                $translation = 'Facebook';
                break;
            case SocialMediaLink::IDENTIFIER_GOOGLEPLUS:
                $translation = 'Google+';
                break;
            case SocialMediaLink::IDENTIFIER_INSTAGRAM:
                $translation = 'Instagram';
                break;
            case SocialMediaLink::IDENTIFIER_LINKEDIN:
                $translation = 'LinkedIn';
                break;
            case SocialMediaLink::IDENTIFIER_TWITTER:
                $translation = 'Twitter';
                break;
            default:
                $translation = '';
        }
        
        return $translation;
    }
    
    /**
     * Translate the status of the social media link
     * 
     * @param string $status
     * 
     * @return string
     */
    private function translateSocialMediaLinkStatus(string $status):string
    {
        switch($status) {
            case SocialMediaLink::STATUS_ACTIVE:
                $translation = 'Actief';
                break;
            case SocialMediaLink::STATUS_INACTIVE:
                $translation = 'Inactief';
                break;
            default:
                $translation = '';
        }
        
        return $translation;
    }
}