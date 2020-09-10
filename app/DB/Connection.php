<?php

namespace App\DB;
use Exception;
require dirname(__DIR__) . '/../config.php';

class  Connection
{
    /**
     * @return false|\mysqli|string
     */
    public function make()
    {
        try {
            return mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        } catch (Exception $e) {
            return 'Database Connection Error ' . mysqli_connect_error(self::$con);
        }
    }
}