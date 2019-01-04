<?php
declare(strict_types = 1);

namespace App\Business;

use App\Data\SocialMediaLinkDAO;
use App\Entities\SocialMediaLink;

use stdClass;

class SocialMediaLinkService
{
    /**
     * Get an array with all social media links
     * 
     * @return array
     */
    public function getAll():array 
    {
        $socialMediaLinkDAO = new SocialMediaLinkDAO();
        $socialMediaLinks   = $socialMediaLinkDAO->getAll();
        
        return $socialMediaLinks;
    }
    
    /**
     * Get the information of a social media link specified by its id
     * 
     * @param int $id
     * 
     * @return SocialMediaLink|null
     */
    public function getById(int $id):?SocialMediaLink
    {
        $socialMediaLinkDAO = new SocialMediaLinkDAO();
        $socialMediaLink    = $socialMediaLinkDAO->getById($id);
        
        return $socialMediaLink;
    }
    
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
    
    /**
     * Update an existing social media link
     * 
     * @param SocialMediaLink $socialMediaLink
     * 
     * @return void
     */
    public function update(SocialMediaLink $socialMediaLink):void
    {
        $socialMediaLinkDAO = new SocialMediaLinkDAO();
        $socialMediaLinkDAO->update($socialMediaLink);
    }
    
    /**
     * Delete an existing social media link
     * 
     * @param int $socialMediaLinkId
     * 
     * @return void
     */
    public function delete(int $socialMediaLinkId):void
    {
        $socialMediaLinkDAO = new SocialMediaLinkDAO();
        $socialMediaLinkDAO->delete($socialMediaLinkId);
    }
    
    /**
     * Validate the social media link
     * 
     * @param stdClass $tmpLink
     * 
     * @return stdClass
     */
    public function validateSocialMediaLink(stdClass $tmpLink):stdClass
    {
        $validationSvc = new ValidationService();
        
        $errors          = new stdClass();
        $errors->isValid = true;
    
        $identifierErrors = $validationSvc->validateTextField($tmpLink->identifier, 50);

        if ($identifierErrors === '') {
            $identifierErrors = $validationSvc->checkUniqueSocialMediaLinkIdentifier(
                $tmpLink->identifier,
                $tmpLink->id
            );
        }

        if ($identifierErrors !== '') {
            $errors->identifier = $identifierErrors;
            $errors->isValid    = false;
        }

        $urlErrors = $validationSvc->validateTextField($tmpLink->url, 255);

        if ($urlErrors === '') {
            $urlErrors = $validationSvc->checkUrl($tmpLink->url);
        }

        if ($urlErrors !== '') {
            $errors->url     = $urlErrors;
            $errors->isValid = false;
        }

        $statusErrors = $validationSvc->validateTextField($tmpLink->status, 20);

        if ($statusErrors !== '') {
            $errors->status  = $statusErrors;
            $errors->isValid = false;
        }
        
        return $errors;
    }
}