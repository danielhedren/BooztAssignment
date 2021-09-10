<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;

class Order extends Entity
{
    private int $customer_id;
    private string $date;
    private ?string $countryCode;
    private ?string $device; // Not sure what this is supposed to represent. This could hold a device identifier, for example.

    public function getDate(): DateTime
    {
        return new DateTime($this->date);
    }
}