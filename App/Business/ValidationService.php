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
     * Combined function to validate a text field
     * 
     * @param string $value
     * @param int $maxLength
     * @param int|null $minLength
     * 
     * @return string
     */
    public function validateTextField(
        string $value,
        int $maxLength,
        ?int $minLength = null
    ):string {
        $result = $this->checkRequired($value);
            
        if ($result === '') {
            $result = $this->checkMaxLength($value, $maxLength);
        }
        
        if ($result === '' && $minLength !== null) {
            $result = $this->checkMinLength($value, $minLength);
        }
        
        return $result;
    }
    
    /**
     * Combined functions to validate email fields
     * 
     * @param string $value
     * @param int $maxLength
     * @param int|null $minLength
     * 
     * @return string
     */
    public function validateEmailField(
        string $value,
        int $maxLength,
        ?int $minLength = null
    ):string {
        $result = $this->validateTextField($value, $maxLength, $minLength);
        
        if ($result === '') {
            $result = $this->checkEmail($value);
        }
        
        return $result;
    }
    
    /**
     * Combined functions to validate password fields
     * 
     * @param string $value
     * @param int $maxLength
     * @param int|null $minLength
     * 
     * @return string
     */
    public function validatePasswordField(
        string $value,
        int $maxLength,
        ?int $minLength = null
    ):string {
        $result = $this->validateTextField($value, $maxLength, $minLength);
        
        if ($result === '') {
            $result = $this->checkSafePassword($value);
        }
        
        return $result;
    }
    
    /**
     * Combined function to validate a confirmed password field
     * 
     * @param string $confirmPassword
     * @param string $password
     * @param int $maxLength
     * @param int|null $minLength
     * 
     * @return string
     */
    public function validateConfirmPasswordField(
        string $confirmPassword,
        string $password,
        int $maxLength,
        ?int $minLength = null
    ):string {
        $result = $this->validateTextField($confirmPassword, $maxLength, $minLength);
        
        if ($result === '') {
            $result = $this->checkConfirmPassword($password, $confirmPassword);
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
    
    /**
     * Check if the given value is not empty
     * 
     * @param string $value
     * 
     * return string
     */
    private function checkRequired(string $value):string
    {
        $result = '';
        
        if (trim($value) === '') {
            $result = 'Dit is een verplicht veld.';
        }
        
        return $result;
    }    
    
    /**
     * Check the min length of the value
     * 
     * @param string $value
     * @param int $length
     * 
     * @return string
     */
    private function checkMinLength(string $value, int $length):string
    {
        $result = '';
        
        if (strlen($value) < $length) {
            $result = 'Dit veld moet min. ' . $length . ' karakters bevatten.';
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
    private function checkMaxLength(string $value, int $length):string
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
    private function checkEmail(string $value):string
    {
        $result = '';
        
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            $result = 'Dit veld moet een geldig e-mail adres bevatten.';
        }
        
        return $result;
    }    
    
    /**
     * Check if the password is safe (must contain at least one letter, one 
     * capital letter, one digit and one special character)
     * 
     * @param string $value
     * 
     * @return string
     */
    private function checkSafePassword(string $value):string
    {
        $result = '';
        
        if (!preg_match('/^((?=.*\d)(?=.*[A-Z])(?=.*[a-z])((?=.*\W)|(?=.*\_)).{8,50})/', $value)) {
            $result = 'Het wachtwoord moet minstens 1 letter, 1 hoofdletter, 1 cijfer en een speciaal karakter bevatten';
        }
        
        return $result;
    }    
    
    /**
     * Check if the passwords agree
     * 
     * @param string $password
     * @param string $confirmPassword
     * 
     * @return string
     */
    private function checkConfirmPassword(
        string $password,
        string $confirmPassword
    ):string {
        $result = '';
        
        if ($password !== $confirmPassword) {
            $result = 'De wachtwoorden komen niet overeen.';
        }
        
        return $result;
    }      
}