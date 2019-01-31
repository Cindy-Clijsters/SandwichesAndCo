<?php
declare(strict_types = 1);

namespace App\Business;

use stdClass;

class FlashService
{
    /**
     * Set a flash message
     * 
     * @param string $name
     * @param string $message
     * @param string $type
     * 
     * @return void
     */
    public function setFlashMessage(string $name, string $message, string $type):void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $flashMessage = new stdClass();
        $flashMessage->message = $message;
        $flashMessage->type    = $type;
        
        $_SESSION[$name] = $flashMessage;
    }
    
    /**
     * Get the flash message
     * 
     * @param string $name
     * 
     * @return array (format = [message, type])
     */
    public function getFlashMessage(string $name): array
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $msg  = '';
        $type =  'secondary';
        
        if (array_key_exists($name, $_SESSION)) {
            
            $flashMsgInfo = $_SESSION[$name];
            
            if (property_exists($flashMsgInfo, 'message')) {
                $msg  = $flashMsgInfo->message;
            }
            
            if (property_exists($flashMsgInfo, 'type')) {
                $type = $flashMsgInfo->type;
            }
            
            unset($_SESSION[$name]);
        }
        
        return [$msg, $type];
    }
}
