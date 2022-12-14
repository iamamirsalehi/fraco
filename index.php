<?php

if (!session_id()) @session_start();

require "vendor/autoload.php";

use Pecee\SimpleRouter\SimpleRouter;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require "config/config-phinx.php";
require "bootstrap/run-eloquent.php";
require "routes/routes.php";

SimpleRouter::start();
