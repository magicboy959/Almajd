<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Keep PHP 8.5 framework deprecations out of API response bodies.
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
ini_set('display_errors', '0');

require_once __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
