<?php
declare(strict_types = 1);

namespace App\Business;

use App\Data\SocialMediaLinkDAO;
use App\Entities\SocialMediaLink;

class SocialMediaLinkService
{
    /**
     * Get the information of a social media link specified by its identifier
     * 
     * @param string $identifier
     * 
     * @return SocialMediaLink|null
     */
    public function getByIdentifier(string $identifier):?SocialMediaLink
    {
        $socialMediaLinkDAO = new SocialMediaLinkDAO();
        $socialMediaLink    = $socialMediaLinkDAO->getByIdentifier($identifier);
        
        return $socialMediaLink;
    }
    
    /**
     * Insert a new social media link
     * 
     * @param SocialMediaLink $socialMediaLink
     * 
     * @return SocialMediaLink
     */
    public function insert(SocialMediaLink $socialMediaLink):SocialMediaLink
    {
        $socialMediaLinkDAO = new SocialMediaLinkDAO();
        $newSocialMediaLink = $socialMediaLinkDAO->insert($socialMediaLink);
        
        return $newSocialMediaLink;
    }
}