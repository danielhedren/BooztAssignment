<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Repository\OrderRepository;
use App\Services\DemoService;
use DateTime;

class HomeController extends Controller
{
    public function index(DateTime $from = null, DateTime $to = null): void
    {
        // This should be sanity checked
        if (isset($_GET['from'])) {
            $from = new DateTime($_GET['from']);
        }

        if (isset($_GET['to'])) {
            $to = new DateTime($_GET['to']);
        }

        $from = $from ?? new DateTime("first day of last month");
        $to = $to ?? new DateTime("last day of last month");

        $orderRepo = new OrderRepository();

        $this->render('Home/Index', [
            'from' => $from,
            'to' => $to,
            'customerCount' => $orderRepo->getDistinctCustomerCountInDateRange($from, $to),
            'orderCount' => $orderRepo->getCountInDateRange($from, $to),
            'revenue' => $orderRepo->getRevenueInDateRange($from, $to),
        ]);
    }

    public function chart(DateTime $from = null, DateTime $to = null): void
    {
        if (isset($_GET['from'])) {
            $from = new DateTime($_GET['from']);
        }

        if (isset($_GET['to'])) {
            $to = new DateTime($_GET['to']);
        }

        $from = $from ?? new DateTime("first day of last month");
        $to = $to ?? new DateTime("last day of last month");

        $orderRepo = new OrderRepository();

        $chartData = $orderRepo->getChartData($from, $to);

        $this->render('Home/Chart', [
            'from' => $from,
            'to' => $to,
            'labels' => array_column($chartData, 'date'),
            'customers' => array_column($chartData, 'customers'),
            'orders' => array_column($chartData, 'orders'),
        ]);
    }
}