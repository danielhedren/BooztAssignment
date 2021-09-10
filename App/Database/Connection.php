<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class Connection
{
    private static ?PDO $connection = null;

    /**
     * Convenience function to get a new PDO connection.
     */
    public static function Open(): PDO
    {
        if (self::$connection === null) {
            self::$connection = new PDO(getenv('DB_CONNECTION_STRING'));
        }

        return self::$connection;
    }
}