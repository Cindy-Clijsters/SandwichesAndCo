<?php
declare(strict_types = 1);

namespace App\Data;

use App\Entities\SocialMediaLink;

use PDO;

class SocialMediaLinkDAO
{
    /**
     * Get the information of a social media link specified by it's identifier
     * 
     * @param string $identifier
     * 
     * @return SocialMediaLink|null
     */
    public function getByIdentifier(string $identifier):?SocialMediaLink
    {
        $socialMediaLink = null;
        
        // Generate the query
        $sql = "SELECT id, identifier, url, status
                FROM social_media_links
                WHERE identifier = :identifier";

        // Open the connection
        $pdo = DbConfig::getPDO();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':identifier' => $identifier]);
        
        // Get the information of the social media link
        if ($stmt->rowCount() > 0) {
            $row             = $stmt->fetch(PDO::FETCH_ASSOC);
            $socialMediaLink = $this->createFromDbRow($row);
        }
        
        // Close the db connection
        $pdo = null;
        
        return $socialMediaLink;       
    }
    
    public function insert(SocialMediaLink $socialMediaLink):SocialMediaLink
    {
        // Generate the query
        $sql = "INSERT into social_media_links(identifier, url, status)
                VALUES (:identifier, :url, :status)";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':identifier' => $socialMediaLink->getIdentifier(),
            ':url'        => $socialMediaLink->getUrl(),
            ':status'     => $socialMediaLink->getStatus()
        ]);
        
        // Update the id of the social media link
        $socialMediaLinkId = $pdo->lastInsertId();
        $socialMediaLink->setId(intVal($socialMediaLinkId));
        
        // Close the connection
        $pdo = null;
        
        // Return the social media link
        return $socialMediaLink;
                
    }
    
    /**
     * Create a social media link from a database row
     * 
     * @param array $row
     * 
     * @return SocialMediaLink|null
     */
    private function createFromDbRow(array $row):?SocialMediaLink
    {
        $socialMediaLink = null;
        
        if (
            array_key_exists('identifier', $row)
            && array_key_exists('url', $row) 
            && array_key_exists('status', $row)
        ) {
            
            $socialMediaLink = new SocialMediaLink(
                $row['identifier'],
                $row['url'],
                $row['status']
            );
            
            if (array_key_exists('id', $row)) {
                $socialMediaLink->setId(intVal($row['id']));
            }
        }
        
        return $socialMediaLink;
    }
}