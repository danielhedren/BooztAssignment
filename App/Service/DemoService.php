<?php

declare(strict_types=1);

namespace App\Service;

use App\Database\Connection;
use App\Repository\CustomerRepository;
use App\Service\Service;
use DateTime;

class DemoService implements Service
{
    public function generateDemoOrders()
    {
        $customerRepo = new CustomerRepository();

        $customers = $customerRepo->findAll();

        $conn = Connection::Open();

        foreach ($customers as $customer) {
            for ($i = 0; $i < rand(10, 20); $i++) {
                $days = rand(0, 60);
                $date = new DateTime("now -{$days} days");

                $stmt = $conn->prepare('INSERT INTO `Order` (customer_id, date) VALUES (:customerId, :date)');
                $stmt->execute([
                    ':customerId' => $customer->getId(),
                    ':date' => $date->format('Y-m-d')
                ]);

                $stmt = $conn->prepare('INSERT INTO `OrderItem` (order_id, quantity, price) VALUES (LAST_INSERT_ID(), :quantity, :price)');
                $stmt->execute([
                    'quantity' => rand(1, 5),
                    'price' => rand(50, 150)
                ]);
            }
        }
    }
}