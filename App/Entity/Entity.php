<?php

declare(strict_types=1);

namespace App\Entity;

abstract class Entity
{
    protected int $id; // For this project every entity must have an integer identifier.

    public function getId(): int
    {
        return $this->id;
    }
}