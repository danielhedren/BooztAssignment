<?php

declare(strict_types=1);

namespace App\Entity;

class Customer extends Entity
{
    private string $firstName;
    private string $lastName;
    private string $email;

    public function getEmail(): string
    {
        return $this->email;
    }
}