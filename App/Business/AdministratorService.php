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
    
    /**
     * Update an existing administrator
     * 
     * @param Administrator $administrator
     * 
     * @return void
     */
    public function update(Administrator $administrator):void
    {
        $administratorDAO = new AdministratorDAO();
        $administratorDAO->update($administrator);
    }
    
    /**
     * Delete an existing administrator
     * 
     * @param Administrator $administrator
     * 
     * @return void
     */
    public function delete(Administrator $administrator):void
    {
        $administratorDAO = new AdministratorDAO();
        $administratorDAO->delete($administrator);
    }
    
    /**
     * Get the amount of administrators
     * 
     * @return int
     */
    public function getAmountAdministrators():int
    {
        $administratorDAO = new AdministratorDAO();
        $amount           = $administratorDAO->getAmountAdministrators();
        
        return $amount;
    }
    
    /**
     * Get the information of the logged in administrator
     * 
     * @return Administrator|null
     */
    public function getLoggedInAdministrator():?Administrator
    {
        $result = null;
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (array_key_exists('adminId', $_SESSION)) {
            
            $administrator = $this->getById($_SESSION['adminId']);
            
            if (
                $administrator !== null
                && $administrator->getStatus() === Administrator::STATUS_ACTIVE
            ) {
               $result = $administrator; 
            }
        }
        
        return $result;
    }
    
    /**
     * Destroy session and redirect to login page
     * 
     * @return void
     */
    public function logout():void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header("location: login.php");
        exit(0);
    }
}