<?php

namespace App\Core\Migration;

use PDO;

class PDOConnection
{
    public static function init()
    {
        $conn = new PDO("mysql:host=" . DBConfig::HOST . ";dbname=" . DBConfig::NAME . "", DBConfig::USER, DBConfig::PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}