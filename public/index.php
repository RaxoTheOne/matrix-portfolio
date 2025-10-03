<?php

// Suppress PHP notices/warnings/deprecations from being displayed in the browser
// while actively programming. Errors will still be logged according to the
// application's logging configuration.
// Display errors should be configured via environment (.env) or php.ini, not hardcoded here.
ini_set('display_errors', '1'); // Show all errors during development

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
