<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection;
use App\Entity\Order;
use DateTime;
use PDO;

class OrderRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Order::class, 'Order');
    }

    public function find(int $id): ?Order
    {
        return parent::find($id);
    }

    /**
     * @return array<array-key, Order>
     */
    public function findAll()
    {
        return parent::findAll();
    }

    public function getCountInDateRange(DateTime $from, DateTime $to): int
    {
        $conn = Connection::Open();
        $stmt = $conn->prepare('SELECT COUNT(*) FROM `Order` o JOIN OrderItem i ON i.order_id = o.id WHERE o.date >= :dateFrom AND o.date <= :dateTo');
        $stmt->execute([
            ':dateFrom' => $from->format('Y-m-d'),
            ':dateTo' => $to->format('Y-m-d')
        ]);
        
        return intval($stmt->fetchColumn());
    }

    public function getDistinctCustomerCountInDateRange(DateTime $from, DateTime $to): int
    {
        $conn = Connection::Open();
        $stmt = $conn->prepare('SELECT COUNT(DISTINCT(customer_id)) FROM `Order` WHERE date >= :dateFrom AND date <= :dateTo');
        $stmt->execute([
            ':dateFrom' => $from->format('Y-m-d'),
            ':dateTo' => $to->format('Y-m-d')
        ]);
        
        return intval($stmt->fetchColumn());
    }

    public function getRevenueInDateRange(DateTime $from, DateTime $to): string
    {
        $conn = Connection::Open();
        $stmt = $conn->prepare('SELECT COALESCE(SUM(i.quantity * i.price), 0) FROM `Order` o JOIN OrderItem i ON i.order_id = o.id WHERE o.date >= :dateFrom AND o.date <= :dateTo');
        $stmt->execute([
            ':dateFrom' => $from->format('Y-m-d'),
            ':dateTo' => $to->format('Y-m-d')
        ]);
        
        // PHP has no non-floating numeric type, so return it as a string.
        return $stmt->fetchColumn();
    }

    public function getChartData(DateTime $from, DateTime $to)
    {
        $conn = Connection::Open();
        $stmt = $conn->prepare('SELECT DATE(date) as date, COUNT(*) as orders, COUNT(DISTINCT(customer_id)) as customers FROM `Order` WHERE date >= :dateFrom AND date <= :dateTo GROUP BY DATE(date)');
        $stmt->execute([
            ':dateFrom' => $from->format('Y-m-d'),
            ':dateTo' => $to->format('Y-m-d')
        ]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}