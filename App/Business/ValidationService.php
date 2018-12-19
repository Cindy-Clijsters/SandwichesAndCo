<?php
declare(strict_types = 1);

namespace App\Business;

use App\Business\AdministratorService;

/**
 * Validation services
 * 
 * Holds functions for validating the user input
 */
class ValidationService
{
    /**
     * Check if the given value is not empty
     * 
     * @param string $value
     * 
     * return string
     */
    public function checkRequired(string $value):string
    {
        $result = '';
        
        if (trim($value) === '') {
            $result = 'Dit is een verplicht veld.';
        }
        
        return $result;
    }    
    
    /**
     * Check the max length of the value
     * 
     * @param string $value
     * @param int $length
     * 
     * @return string
     */
    public function checkMaxLength(string $value, int $length):string
    {
        $result = '';
        
        if (strlen($value) > $length) {
            $result = 'Dit veld mag max. ' . $length . ' karakters bevatten.';
        }
        
        return $result;
    }
    
    /**
     * Check if the value is a valid e-mail address
     * 
     * @param string $value
     * 
     * @return string
     */
    public function checkEmail(string $value):string
    {
        $result = '';
        
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            $result = 'Dit veld moet een geldig e-mail adres bevatten.';
        }
        
        return $result;
    }    
    
    /**
     * Check if the email adress of the administrator is unique
     * 
     * @param string $email
     * @param int $administratorId
     * 
     * @return string
     */
    public function checkUniqueAdministratorMail(
        string $email,
        int $administratorId
    ):string
    {
        $result = '';
        
        $administratorSvc = new AdministratorService();
        $administrator    = $administratorSvc->getByEmail($email);
        
        if (
            ($administrator !== null)
            && ($administrator->getId() !== $administratorId)
        ) {
            $result = 'Dit veld moet een uniek e-mail adres bevatten;';
        }
        
        return $result;
    }
}