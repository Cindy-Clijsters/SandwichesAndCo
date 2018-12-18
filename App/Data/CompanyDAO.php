<?php
declare(strict_types = 1);

namespace App\Data;

use PDO;
use App\Entities\Company;

class CompanyDAO
{
    /**
     * Get the information of the company
     * 
     * @return Company|null
     */
    public function getInfo():?Company
    {
        $company = null;
        
        // Generate the query
        $sql = "SELECT id, name, address, postal_code, city, telephone, email, vat_number, about_us_summary, about_us
                FROM company";
        
        // Open the connection
        $pdo = DbConfig::getPdo();
        
        // Execute the query 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        if ($stmt->rowCount() === 1) {
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $company = new Company(
                $row['name'],
                $row['email']
            );
            
            $company->setId(intval($row['id']));
            $company->setAddress($row['address']);
            $company->setPostalCode($row['postal_code']);
            $company->setCity($row['city']);
            $company->setTelephone($row['telephone']);
            $company->setVatNumber($row['vat_number']);
            $company->setAboutUsSummary($row['about_us_summary']);
            $company->setAboutUs($row['about_us']);
            
        }
        
        // Close the db connection
        $pdo = null;
        
        // Return the result
        return $company;
    }
}
