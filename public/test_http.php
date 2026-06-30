<?php
/**
 * Full HTTP CRUD test — simulates browser requests
 * DELETE THIS FILE AFTER TESTING
 */

define('LARAVEL_START', microtime(true));
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

use Illuminate\Http\Request;

function makeRequest($app, $method, $uri, $data = [], $cookies = [], $sessionData = null) {
    $kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
    $req = Request::create($uri, $method, $data);
    
    // Set cookies
    foreach ($cookies as $k => $v) {
        $req->cookies->set($k, $v);
    }
    
    // Set session
    if ($sessionData) {
        $req->session()->put($sessionData);
    }
    
    $resp = $kernel->handle($req);
    $status = $resp->getStatusCode();
    
    // Collect cookies from response
    $newCookies = [];
    foreach ($resp->headers->getCookies() as $cookie) {
        $newCookies[$cookie->getName()] = $cookie->getValue();
    }
    
    // Get session data
    $sessionStore = $req->session();
    $allSession = $sessionStore->all();
    $sessionId = $sessionStore->getId();
    
    $body = $resp->getContent();
    
    // Extract CSRF token from session
    $csrfToken = $sessionStore->token();
    
    return compact('status', 'body', 'newCookies', 'allSession', 'sessionId', 'csrfToken');
}

echo "=== STEP 1: GET /login ===" . PHP_EOL;
$r1 = makeRequest($app, 'GET', '/login');
echo "Status: {$r1['status']}" . PHP_EOL;
echo "CSRF Token: " . substr($r1['csrfToken'], 0, 20) . "..." . PHP_EOL;
echo "Session ID: {$r1['sessionId']}" . PHP_EOL;
echo "Session data keys: " . implode(', ', array_keys($r1['allSession'])) . PHP_EOL;
$cookies = $r1['newCookies'];
echo "Cookies set: " . implode(', ', array_keys($cookies)) . PHP_EOL;
echo PHP_EOL;

echo "=== STEP 2: POST /login (admin@gmail.com / admin123) ===" . PHP_EOL;
$r2 = makeRequest($app, 'POST', '/login', [
    '_token' => $r1['csrfToken'],
    'email' => 'admin@gmail.com',
    'password' => 'admin123',
    'remember' => 'on',
], $cookies);
echo "Status: {$r2['status']}" . PHP_EOL;
if ($r2['status'] === 419) {
    echo ">>> 419 CSRF MISMATCH!" . PHP_EOL;
    echo "Session token: " . substr($r2['csrfToken'], 0, 20) . "..." . PHP_EOL;
    echo "Session data: " . json_encode($r2['allSession']) . PHP_EOL;
} elseif ($r2['status'] === 302) {
    echo ">>> Redirect to: {$r2['body']}" . PHP_EOL;
} elseif ($r2['status'] === 200) {
    if (str_contains($r2['body'], 'credentials')) {
        echo ">>> Wrong password!" . PHP_EOL;
    } else {
        echo ">>> 200 OK (page returned)" . PHP_EOL;
    }
}
$cookies = array_merge($cookies, $r2['newCookies']);
$session = $r2['allSession'];
echo "Session auth guard: " . ($session['login_web_59ba36ad97e1733e9966accfa762d71c4'] ?? 'NOT SET') . PHP_EOL;
echo PHP_EOL;

echo "=== STEP 3: GET /admin/dashboard ===" . PHP_EOL;
$r3 = makeRequest($app, 'GET', '/admin/dashboard', [], $cookies, $session);
echo "Status: {$r3['status']}" . PHP_EOL;
if ($r3['status'] === 302 && str_contains($r3['body'], 'login')) {
    echo ">>> Redirect to login — NOT AUTHENTICATED" . PHP_EOL;
} elseif ($r3['status'] === 200) {
    echo ">>> Dashboard loaded!" . PHP_EOL;
} else {
    echo ">>> Response: " . substr($r3['body'], 0, 200) . PHP_EOL;
}
echo PHP_EOL;

echo "=== STEP 4: Try password 'password' ===" . PHP_EOL;
$r4 = makeRequest($app, 'POST', '/login', [
    '_token' => $r1['csrfToken'],
    'email' => 'admin@gmail.com',
    'password' => 'password',
    'remember' => 'on',
], $cookies);
echo "Status: {$r4['status']}" . PHP_EOL;
if ($r4['status'] === 302) {
    echo ">>> Redirect: {$r4['body']}" . PHP_EOL;
    $cookies = array_merge($cookies, $r4['newCookies']);
    $session = array_merge($session, $r4['allSession']);
} elseif ($r4['status'] === 200 && str_contains($r4['body'], 'credentials')) {
    echo ">>> Wrong password" . PHP_EOL;
}
echo PHP_EOL;

echo "=== STEP 5: Try password '12345678' ===" . PHP_EOL;
$r5 = makeRequest($app, 'POST', '/login', [
    '_token' => $r1['csrfToken'],
    'email' => 'admin@gmail.com',
    'password' => '12345678',
    'remember' => 'on',
], $cookies);
echo "Status: {$r5['status']}" . PHP_EOL;
if ($r5['status'] === 302) {
    echo ">>> Redirect: {$r5['body']}" . PHP_EOL;
    $cookies = array_merge($cookies, $r5['newCookies']);
    $session = array_merge($session, $r5['allSession']);
}
echo PHP_EOL;

// Now try to access admin CRUD if we got authenticated
if ($r4['status'] === 302 || $r5['status'] === 302) {
    echo "=== STEP 6: GET /admin/page (page list) ===" . PHP_EOL;
    $r6 = makeRequest($app, 'GET', '/admin/page', [], $cookies, $session);
    echo "Status: {$r6['status']}" . PHP_EOL;
    if ($r6['status'] === 200) {
        echo ">>> Page listing loaded!" . PHP_EOL;
    } else {
        echo ">>> " . substr($r6['body'], 0, 300) . PHP_EOL;
    }
    
    echo PHP_EOL . "=== STEP 7: POST /admin/page/delete/Home (test delete) ===" . PHP_EOL;
    $newToken = $r6['csrfToken'];
    $r7 = makeRequest($app, 'POST', '/admin/page/delete/Home', [
        '_token' => $newToken,
    ], $cookies, $session);
    echo "Status: {$r7['status']}" . PHP_EOL;
    if ($r7['status'] === 419) {
        echo ">>> 419 CSRF FAILED on CRUD operation!" . PHP_EOL;
    } elseif ($r7['status'] === 302) {
        echo ">>> Redirect: {$r7['body']}" . PHP_EOL;
        echo ">>> CRUD operation WORKS!" . PHP_EOL;
    } else {
        echo ">>> " . substr($r7['body'], 0, 300) . PHP_EOL;
    }
}

echo PHP_EOL . "=== DONE ===" . PHP_EOL;
echo "DELETE THIS FILE!" . PHP_EOL;
