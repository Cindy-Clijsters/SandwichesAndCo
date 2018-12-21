<?php
declare(strict_types = 1);

namespace App\Business;

use App\Data\CompanyDAO;
use App\Entities\Company;

class CompanyService 
{
    /**
     * Get the information of the company
     * 
     * @return Company|null
     */
    public function getInfo():?Company 
    {
        $companyDAO = new CompanyDAO();
        $company    = $companyDAO->getInfo();
        
        return $company;
    }
    
    /**
     * Update the information of the company
     * 
     * @param Company $company
     * 
     * @return void
     */
    public function update(Company $company):void
    {
        $companyDAO = new CompanyDAO();
        $companyDAO->update($company);
    }
    
}
