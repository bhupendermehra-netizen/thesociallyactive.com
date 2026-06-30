<?php
/**
 * Full HTTP login test — simulates browser behavior
 * DELETE THIS FILE AFTER TESTING
 */
define('LARAVEL_START', microtime(true));
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

use Illuminate\Http\Request;

// Step 1: GET /login — get CSRF token + session cookie
$req1 = Request::create('/login', 'GET');
$resp1 = $kernel->handle($req1);
$token = $req1->session()->token();
$sessId = $req1->session()->getId();
echo "STEP 1 - GET /login: {$resp1->getStatusCode()}" . PHP_EOL;
echo "CSRF Token: " . substr($token, 0, 20) . "..." . PHP_EOL;
echo "Session ID: {$sessId}" . PHP_EOL;

// Extract session cookie name
$cookieName = config('session.cookie');
echo "Cookie name: {$cookieName}" . PHP_EOL;

// Step 2: POST /login with credentials
$req2 = Request::create('/login', 'POST', [
    '_token' => $token,
    'email' => 'admin@gmail.com',
    'password' => 'admin123',
    'remember' => '',
]);
// Copy session from step 1
$req2->setLaravelSession($req1->session());
$resp2 = $kernel->handle($req2);
echo PHP_EOL . "STEP 2 - POST /login: {$resp2->getStatusCode()}" . PHP_EOL;
if ($resp2->getStatusCode() === 419) {
    echo ">>> 419 CSRF MISMATCH!" . PHP_EOL;
    echo "Session token: " . $req2->session()->token() . PHP_EOL;
} elseif ($resp2->getStatusCode() === 302) {
    $location = $resp2->headers->get('Location');
    echo ">>> Redirect to: {$location}" . PHP_EOL;
    // Check if auth guard was set in session
    $authGuard = $req2->session()->get('login_web_' . md5('App\\Http\\Controllers\\Auth\\LoginController'));
    echo ">>> Auth session key: " . ($authGuard ?? 'NOT SET') . PHP_EOL;
    $session = $req2->session()->all();
    echo ">>> Session keys: " . implode(', ', array_keys($session)) . PHP_EOL;
} elseif ($resp2->getStatusCode() === 200) {
    echo ">>> Returned 200 (might be validation error)" . PHP_EOL;
    // Check for error messages in session
    $errors = $req2->session()->get('errors');
    if ($errors) {
        echo ">>> Errors: " . json_encode($errors->toArray()) . PHP_EOL;
    }
}

// Step 3: Test with password 'password'
$req3 = Request::create('/login', 'POST', [
    '_token' => $token,
    'email' => 'admin@gmail.com',
    'password' => 'password',
    'remember' => '',
]);
$req3->setLaravelSession($req1->session());
$resp3 = $kernel->handle($req3);
echo PHP_EOL . "STEP 3 - POST /login (password='password'): {$resp3->getStatusCode()}" . PHP_EOL;
if ($resp3->getStatusCode() === 302) {
    echo ">>> Redirect to: " . $resp3->headers->get('Location') . PHP_EOL;
    $session3 = $req3->session()->all();
    echo ">>> Session keys: " . implode(', ', array_keys($session3)) . PHP_EOL;
    $authGuard = $req3->session()->get('login_web_' . md5('App\\Http\\Controllers\\Auth\\LoginController'));
    echo ">>> Auth: " . ($authGuard ?? 'NOT SET') . PHP_EOL;
}

echo PHP_EOL . "DONE" . PHP_EOL;
echo "DELETE THIS FILE!" . PHP_EOL;
