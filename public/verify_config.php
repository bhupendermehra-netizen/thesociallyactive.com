<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$kernel->handle($request = Illuminate\Http\Request::capture());
echo "Session driver: " . config('session.driver') . PHP_EOL;
echo "APP_URL: " . config('app.url') . PHP_EOL;
echo "APP_DEBUG: " . var_export(config('app.debug'), true) . PHP_EOL;
echo "Session cookie: " . config('session.cookie') . PHP_EOL;
echo "Session path: " . config('session.path') . PHP_EOL;
echo "Session domain: " . var_export(config('session.domain'), true) . PHP_EOL;
