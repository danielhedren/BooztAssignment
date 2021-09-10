<?php

declare(strict_types=1);

namespace App\Controller;

use RuntimeException;

abstract class Controller
{
    private $model;

    public function render(string $view, $model = null): void
    {
        $this->model = $model;

        $path = ROOT_DIR.'/App/View/'.$view.'.php';

        if (!file_exists($path)) {
            // This would leak information about the system to users which is to be avoided.
            throw new RuntimeException("Could not find view \"{$view}\" in \"{$path}\"");
        }

        require_once($path);
    }

    public function redirect(string $path): void
    {
        header("Location: /?route={$path}");
        exit();
    }
}