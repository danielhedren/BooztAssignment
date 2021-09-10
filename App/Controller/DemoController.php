<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\DemoService;

class DemoController extends Controller
{
    /**
     * Generates some random data for demo purposes.
     */
    public function generate(): void
    {
        $demoService = new DemoService();
        $demoService->generateDemoOrders();

        $this->redirect('/');
    }
}
