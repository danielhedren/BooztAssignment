<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection;
use App\Entity\Customer;
use PDO;

class CustomerRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Customer::class, 'Customer');
    }

    public function find(int $id): ?Customer
    {
        return parent::find($id);
    }

    /**
     * @return array<array-key, Customer>
     */
    public function findAll()
    {
        return parent::findAll();
    }
}