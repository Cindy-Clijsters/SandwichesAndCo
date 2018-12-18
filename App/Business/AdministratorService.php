<?php
declare(strict_types = 1);

namespace App\Business;

use App\Data\AdministratorDAO;
use App\Entities\Administrator;

class AdministratorService
{
    /**
     * Get the info specified by the id
     * 
     * @param int $id
     * 
     * @return Administrator|null
     */
    public function getById(int $id):?Administrator
    {
       $administratorDAO = new AdministratorDAO();
       $administrator    = $administratorDAO->getById($id);
       
       return $administrator;
    }
    
    /**
     * Get the info specified the by email address
     * 
     * @param string $email
     * 
     * @return Administator|null
     */
    public function getByEmail(string $email):?Administrator
    {
        $administratorDAO = new AdministratorDAO();
        $administrator     = $administratorDAO->getByEmail($email);
        
        return $administrator;
    }
}