<?php

declare(strict_types=1);

spl_autoload_register(function ($class) {
    // PSR-4 requires us to use a namespace prefix. This is not actually required for this small project.
    $prefix = NAMESPACE_PREFIX;

    // Ignore classes whose namespace do not start with our prefix
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $baseDir = ROOT_DIR . '/' . 'App';

    $path = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // PSR-4 does not allow us to throw exceptions or error out, so just ignore missing files.
    if (file_exists($path)) {
        require $path;
    }
});