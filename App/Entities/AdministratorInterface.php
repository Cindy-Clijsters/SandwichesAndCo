<?php
declare(strict_types = 1);

namespace App\Entities;

use DateTime;

interface AdministratorInterface
{
    public static function map(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $status,
        DateTime $createdAt
    ): Administrator;
    
    public function setId(int $id);
    public function getId():int;
    public function setFirstName(string $firstname);
    public function getFirstName():string;
    public function setLastName(string $lastname);
    public function getLastName():string;
    public function getFullName():string;
    public function setEmail(string $email);
    public function getEmail():string;
    public function setPassword(string $password);
    public function getPassword():string;
    public function setStatus(string $status);
    public function getStatus():string;
    public function setCreatedAt(DateTime $createdAt);
    public function getCreatedAt():DateTime;

}
