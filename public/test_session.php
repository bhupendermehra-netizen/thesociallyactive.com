<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

use Illuminate\Http\Request;

echo "SESSION_DRIVER config: " . config('session.driver') . PHP_EOL;
echo "SESSION_DRIVER env: " . (env('SESSION_DRIVER') ?? 'NOT SET in .env') . PHP_EOL;
echo PHP_EOL;

// Simulate a GET to login page
$getReq = Request::create('/login', 'GET');
$getResp = $kernel->handle($getReq);
echo "GET /login status: " . $getResp->getStatusCode() . PHP_EOL;

// Get the CSRF token from session
$csrfToken = $getReq->session()->token();
echo "CSRF token: " . substr($csrfToken, 0, 30) . "..." . PHP_EOL;

// Now try POST login with same session and token
$postReq = Request::create('/login', 'POST', [
    '_token' => $csrfToken,
    'email' => 'admin@gmail.com',
    'password' => 'admin123',
    'remember' => 'on',
]);
// Share session
$postReq->setLaravelSession($getReq->session());

$kernel2 = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$postResp = $kernel2->handle($postReq);
echo "POST /login status: " . $postResp->getStatusCode() . PHP_EOL;

if ($postResp->getStatusCode() === 419) {
    echo ">>> 419 PAGE EXPIRED - CSRF validation FAILED!" . PHP_EOL;
} elseif ($postResp->getStatusCode() === 302) {
    echo ">>> 302 REDIRECT to: " . $postResp->headers->get('Location') . PHP_EOL;
} elseif ($postResp->getStatusCode() === 200) {
    $body = $postResp->getContent();
    if (strpos($body, 'credentials') !== false || strpos($body, 'invalid') !== false) {
        echo ">>> Login FAILED (wrong credentials or validation error)" . PHP_EOL;
    } else {
        echo ">>> 200 OK" . PHP_EOL;
    }
}

// Also test: Does the session actually work across multiple kernel instances?
echo PHP_EOL . "=== Session persistence test ===" . PHP_EOL;
$getReq->session()->put('test_persist', 'hello');
echo "Set test_persist = 'hello' in session" . PHP_EOL;

// New kernel, new request, same session id
$testReq = Request::create('/test', 'GET');
$testReq->cookies->set(session()->getName(), $getReq->session()->getId());
$kernel3 = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$kernel3->handle($testReq);
$val = $testReq->session()->get('test_persist');
echo "Read test_persist from new kernel: " . ($val ?? 'NULL') . PHP_EOL;
