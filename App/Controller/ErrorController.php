<?php

declare(strict_types=1);

namespace App\Controller;

class ErrorController extends Controller
{
    public function default(string $message): void
    {
        $this->render('Error/Default', [
            'message' => $message,
        ]);
    }
}