<?php
/**
 * Quick CRUD diagnostic - runs through Laravel HTTP kernel
 * DELETE THIS FILE AFTER TESTING
 */

define('LARAVEL_START', microtime(true));

// Register the Composer autoloader
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

echo "=== LARAVEL BOOTSTRAP TEST ===" . PHP_EOL;
try {
    $response = $kernel->handle(
        $request = \Illuminate\Http\Request::capture()
    );
    echo "Laravel kernel: OK" . PHP_EOL;
} catch (\Exception $e) {
    echo "Laravel kernel FAILED: " . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}

echo PHP_EOL . "=== DB CONNECTION TEST ===" . PHP_EOL;
try {
    $pdo = \Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "DB connected OK via: " . \Illuminate\Support\Facades\DB::connection()->getConfig('host') . PHP_EOL;
    echo "Database: " . \Illuminate\Support\Facades\DB::connection()->getConfig('database') . PHP_EOL;
} catch (\Exception $e) {
    echo "DB CONNECTION FAILED: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . "=== MODEL CRUD TESTS ===" . PHP_EOL;

// Test Pages
echo "--- Pages ---" . PHP_EOL;
try {
    $count = \App\Models\Page::count();
    echo "Page count: $count" . PHP_EOL;
    
    $testPage = new \App\Models\Page();
    $testPage->page = '__TEST_DELETE_ME__';
    $testPage->title = 'Test';
    $testPage->section = 'test';
    $testPage->fields = '[]';
    $testPage->save();
    echo "Page CREATE: OK (id={$testPage->id})" . PHP_EOL;
    
    $testPage->title = 'Updated';
    $testPage->save();
    echo "Page UPDATE: OK" . PHP_EOL;
    
    $testPage->delete();
    echo "Page DELETE: OK" . PHP_EOL;
} catch (\Exception $e) {
    echo "Pages CRUD FAILED: " . $e->getMessage() . PHP_EOL;
}

// Test Blogs
echo "--- Blogs ---" . PHP_EOL;
try {
    $count = \App\Models\Blog::count();
    echo "Blog count: $count" . PHP_EOL;
    
    $testBlog = new \App\Models\Blog();
    $testBlog->title = '__TEST_DELETE_ME__';
    $testBlog->slug = 'test-delete-me-' . time();
    $testBlog->content = 'test';
    $testBlog->save();
    echo "Blog CREATE: OK (id={$testBlog->id})" . PHP_EOL;
    
    $testBlog->title = 'Updated';
    $testBlog->save();
    echo "Blog UPDATE: OK" . PHP_EOL;
    
    $testBlog->delete();
    echo "Blog DELETE: OK" . PHP_EOL;
} catch (\Exception $e) {
    echo "Blogs CRUD FAILED: " . $e->getMessage() . PHP_EOL;
}

// Test Projects
echo "--- Projects ---" . PHP_EOL;
try {
    $count = \App\Models\Project::count();
    echo "Project count: $count" . PHP_EOL;
    
    $testProject = new \App\Models\Project();
    $testProject->title = '__TEST_DELETE_ME__';
    $testProject->save();
    echo "Project CREATE: OK (id={$testProject->id})" . PHP_EOL;
    
    $testProject->title = 'Updated';
    $testProject->save();
    echo "Project UPDATE: OK" . PHP_EOL;
    
    $testProject->delete();
    echo "Project DELETE: OK" . PHP_EOL;
} catch (\Exception $e) {
    echo "Projects CRUD FAILED: " . $e->getMessage() . PHP_EOL;
}

// Test Blog Categories
echo "--- Blog Categories ---" . PHP_EOL;
try {
    $count = \App\Models\BlogCategory::count();
    echo "BlogCategory count: $count" . PHP_EOL;
    
    $testCat = new \App\Models\BlogCategory();
    $testCat->name = '__TEST_DELETE_ME__';
    $testCat->slug = 'test-delete-me';
    $testCat->save();
    echo "BlogCategory CREATE: OK (id={$testCat->id})" . PHP_EOL;
    
    $testCat->name = 'Updated';
    $testCat->save();
    echo "BlogCategory UPDATE: OK" . PHP_EOL;
    
    $testCat->delete();
    echo "BlogCategory DELETE: OK" . PHP_EOL;
} catch (\Exception $e) {
    echo "BlogCategories CRUD FAILED: " . $e->getMessage() . PHP_EOL;
}

// Test Authors
echo "--- Authors ---" . PHP_EOL;
try {
    $count = \App\Models\Author::count();
    echo "Author count: $count" . PHP_EOL;
    
    $testAuthor = new \App\Models\Author();
    $testAuthor->name = '__TEST_DELETE_ME__';
    $testAuthor->save();
    echo "Author CREATE: OK (id={$testAuthor->id})" . PHP_EOL;
    
    $testAuthor->name = 'Updated';
    $testAuthor->save();
    echo "Author UPDATE: OK" . PHP_EOL;
    
    $testAuthor->delete();
    echo "Author DELETE: OK" . PHP_EOL;
} catch (\Exception $e) {
    echo "Authors CRUD FAILED: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . "=== SESSION TEST ===" . PHP_EOL;
try {
    $session = \Illuminate\Support\Facades\Session::driver();
    $session->put('test_key', 'test_value');
    $val = $session->get('test_key');
    echo "Session: " . ($val === 'test_value' ? 'OK' : 'FAILED') . PHP_EOL;
    $session->forget('test_key');
} catch (\Exception $e) {
    echo "Session FAILED: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . "=== FILE UPLOAD TEST ===" . PHP_EOL;
$uploadDir = public_path('uploaded_files/image');
echo "Upload dir exists: " . (is_dir($uploadDir) ? 'YES' : 'NO') . PHP_EOL;
echo "Upload dir writable: " . (is_writable($uploadDir) ? 'YES' : 'NO') . PHP_EOL;

$blogDir = public_path('images/blogs');
echo "Blog images dir exists: " . (is_dir($blogDir) ? 'YES' : 'NO') . PHP_EOL;
echo "Blog images dir writable: " . (is_writable($blogDir) ? 'YES' : 'NO') . PHP_EOL;

$imagesDir = public_path('images');
echo "Images dir exists: " . (is_dir($imagesDir) ? 'YES' : 'NO') . PHP_EOL;
echo "Images dir writable: " . (is_writable($imagesDir) ? 'YES' : 'NO') . PHP_EOL;

echo PHP_EOL . "=== AUTH CHECK ===" . PHP_EOL;
try {
    $user = \App\Models\User::first();
    echo "User: {$user->name} ({$user->email})" . PHP_EOL;
    echo "Hash check 'admin123': " . (\Illuminate\Support\Facades\Hash::check('admin123', $user->password) ? 'MATCH' : 'no match') . PHP_EOL;
    echo "Hash check 'password': " . (\Illuminate\Support\Facades\Hash::check('password', $user->password) ? 'MATCH' : 'no match') . PHP_EOL;
    echo "Hash check 'secret': " . (\Illuminate\Support\Facades\Hash::check('secret', $user->password) ? 'MATCH' : 'no match') . PHP_EOL;
    echo "Hash check 'admin': " . (\Illuminate\Support\Facades\Hash::check('admin', $user->password) ? 'MATCH' : 'no match') . PHP_EOL;
    echo "Hash check '12345678': " . (\Illuminate\Support\Facades\Hash::check('12345678', $user->password) ? 'MATCH' : 'no match') . PHP_EOL;
} catch (\Exception $e) {
    echo "Auth FAILED: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . "=== DONE ===" . PHP_EOL;
echo "DELETE THIS FILE: /public/test_crud.php" . PHP_EOL;
