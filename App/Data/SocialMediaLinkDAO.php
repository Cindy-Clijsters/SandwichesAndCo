<?php
declare(strict_types = 1);

namespace App\Data;

use App\Entities\SocialMediaLink;

use PDO;

class SocialMediaLinkDAO
{
    /**
     * Get an array with all social media links
     * 
     * @return array
     */
    public function getAll():array
    {
        $result = [];
        
        // Generate the query
        $sql = "SELECT id, identifier, url, status
                FROM social_media_links
                ORDER BY identifier";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $resultSet = $pdo->query($sql);
        
        // Add the results to the array
        foreach ($resultSet as $row) {
            
            $socialMediaLink = $this->createFromDbRow($row);
            
            if ($socialMediaLink !== null) {
                array_push($result, $socialMediaLink);
            }
            
        }
        
        // Close the connection
        $pdo = null;
        
        // Return the result
        return $result;
    }
    
    /**
     * Get the information of a social media link specified by it's id
     * 
     * @param int $id
     * 
     * @return SocialMediaLink|null
     */
    public function getById(int $id):?SocialMediaLink
    {
        $socialMediaLink = null;
        
        // Generate the query
        $sql = "SELECT id, identifier, url, status
                FROM social_media_links 
                WHERE id = :id";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        // Get the information of the social media link
        if ($stmt->rowCount() > 0) {
            $row             = $stmt->fetch(PDO::FETCH_ASSOC);
            $socialMediaLink = $this->createFromDbRow($row);
        }
        
        // Close the db connection
        $pdo = null;
        
        return $socialMediaLink;          
    }
    
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
        $pdo = DbConfig::getPdo();
        
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
    
    /**
     * Insert a new social media link
     * 
     * @param SocialMediaLink $socialMediaLink
     * 
     * @return SocialMediaLink
     */
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
     * Update the information of the social media link
     * 
     * @param SocialMediaLink $socialMediaLink
     * 
     * @return void
     */
    public function update(SocialMediaLink $socialMediaLink):void
    {
        // Generate the query
        $sql = "UPDATE social_media_links
                SET identifier = :identifier,
                    url = :url,
                    status = :status
                WHERE id = :id";
           
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':identifier' => $socialMediaLink->getIdentifier(),
            ':url'        => $socialMediaLink->getUrl(),
            ':status'     => $socialMediaLink->getStatus(),
            ':id'         => $socialMediaLink->getId()
        ]);
        
        // Close the connection
        $pdo = null;
    }
    
    /**
     * Delete an existing social media link
     * 
     * @param int $id
     * 
     * @return void
     */
    public function delete(int $id):void
    {
        // Generate the query
        $sql = "DELETE 
                FROM social_media_links
                WHERE id = :id";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        
        // Close the connection
        $pdo = null;
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
            array_key_exists('id', $row)
            && array_key_exists('identifier', $row)
            && array_key_exists('url', $row) 
            && array_key_exists('status', $row)
        ) {
            $socialMediaLink = SocialMediaLink::Map(   
                intVal($row['id']),
                $row['identifier'],
                $row['url'],
                $row['status']
            );
        }
        
        return $socialMediaLink;
    }
}