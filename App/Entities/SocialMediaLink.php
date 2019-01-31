<?php
declare(strict_types = 1);

namespace App\Entities;

/**
 * Class SocialMediaLink
 *
 * Hold the properties of the social media links
 */
class SocialMediaLink
{
    private $id;
    private $identifier;
    private $url;
    private $status;
    
    private static $idMap = [];
    
    const STATUS_ACTIVE   = "active";
    const STATUS_INACTIVE = "inactive";
    
    const IDENTIFIER_FACEBOOK   = "facebook";
    const IDENTIFIER_GOOGLEPLUS = "googleplus";
    const IDENTIFIER_INSTAGRAM  = "instagram";
    const IDENTIFIER_LINKEDIN   = "linkedin";
    const IDENTIFIER_TWITTER    = "twitter";
    
    /**
     * Constructor function
     * 
     * @param string $identifier
     * @param string $url
     * @param string $status
     * 
     * @return void
     */
    public function __construct(
        string $identifier,
        string $url,
        string $status = self::STATUS_ACTIVE
    ) {
        $this->identifier = $identifier;
        $this->url        = $url;
        $this->status     = $status;
    } 
    
    /**
     * Map a social media link
     * 
     * @param int $id
     * @param string $identifier
     * @param string $url
     * @param string $status
     * 
     * @return SocialMediaLink
     */
    public static function map(
        int $id,
        string $identifier,
        string $url,
        string $status
    ):SocialMediaLink {
        if (!isset(self::$idMap[$id])) {
            
            $socialMediaLink = new SocialMediaLink(
                $identifier,
                $url,
                $status
            );
            
            $socialMediaLink->setId($id);
            
            self::$idMap[$id] = $socialMediaLink;
            
        } 
            
        return self::$idMap[$id];
    }
    
    /**
     * Set the id of the social media link
     * 
     * @param int $id
     * 
     * @return SocialMediaLink
     */
    public function setId(int $id):SocialMediaLink
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * Get the id of the social media link
     * 
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }
    
    /**
     * Set the identifier of the social media link
     * 
     * @param string $identifier
     * 
     * @return SocialMediaLink
     */
    public function setIdentifier(string $identifier):SocialMediaLink
    {
        $this->identifier = $identifier;
        return $this;
    }
    
    /**
     * Get the identifier of the social media link
     * 
     * @return string
     */
    public function getIdentifier():string
    {
        return $this->identifier;
    }
    
    /**
     * Get an array with all identifiers
     * 
     * @return array
     */
    public static function getAllIdentifiers():array
    {
        return [
            self::IDENTIFIER_FACEBOOK,
            self::IDENTIFIER_GOOGLEPLUS,
            self::IDENTIFIER_INSTAGRAM,
            self::IDENTIFIER_LINKEDIN,
            self::IDENTIFIER_TWITTER
        ];
    }
    
    /**
     * Set the url of the social media link
     * 
     * @param string $url
     * 
     * @return SocialMediaLink
     */
    public function setUrl(string $url):SocialMediaLink
    {
        $this->url = $url;
        return $this;
    }
    
    /**
     * Get the url of the social media link
     * 
     * @return string
     */
    public function getUrl():string
    {
        return $this->url;
    }
    
    /**
     * Set the status of the social media link
     * 
     * @param string $status
     * 
     * @return SocialMediaLink
     */
    public function setStatus(string $status):SocialMediaLink
    {
        $this->status = $status;
        return $this;
    }
    
    /**
     * Get the status of the social media link
     * 
     * @return string
     */
    public function getStatus():string
    {
        return $this->status;
    }
    
    /**
     * Get an array with all the statuses
     * 
     * @return array
     */
    public static function getAllStatuses():array
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE
        ];
    }
    
}
