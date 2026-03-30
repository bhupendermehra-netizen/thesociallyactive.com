<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ExtraImageController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Auth;

Route::get("/", [ManageController::class,"index"])->name("index");
Route::get("/story", [ManageController::class,"about"])->name("about");
Route::get("/contact", [ManageController::class,"contact"])->name("contact");
Route::get("/projects", [ManageController::class,"projects"])->name("projects");

Route::get("/service/{slug}", [ManageController::class,"service"])->name("service");
Route::get("/page/{slug}", [ManageController::class,"extraPage"])->name("extra.page");

Route::post("/query", [ManageController::class,"queryStore"])->name("query");
Route::get("/thankyou", [ManageController::class,"thankyou"])->name("thankyou");

Auth::routes();

Route::prefix("admin")->name("admin.")->middleware("auth")->group(function(){
    Route::get('/dashboard', [ManageController::class, 'dashboard'])->name('dashboard');

    // Page
    Route::get("page",[ManageController::class,"page"])->name("page");
    Route::get("page/view/{page}",[ManageController::class,"pageView"])->name("page.view");
    Route::get("page/add",[ManageController::class,"pageAdd"])->name("page.add");
    Route::get("page/edit/{id}",[ManageController::class,"pageEdit"])->name("page.edit");
    Route::post("page/edit/{id}",[ManageController::class,"pageUpdate"])->name("page.update");
    Route::post("page/add",[ManageController::class,"pageStore"])->name("page.add");

    // Profile
    Route::get("profile",[ManageController::class,"profile"])->name("profile");
    Route::post("profile/update",[ManageController::class,"profileUpdate"])->name("profile.update");

    // Page SEO
    Route::get("page/seo/{page}",[ManageController::class,"seo"])->name("page.seo");
    Route::post("page/seo/{page}",[ManageController::class,"seoUpdate"])->name("page.seo.update");
	
	// Profile
    Route::get("query",[ManageController::class,"query"])->name("query");

    Route::post("query/{id}/delete",[ManageController::class,"queryDelete"])->name("query.delete");

    // ExtraImage
    Route::get("extraImage/view/{page}",[ExtraImageController::class,"index"])->name("extraImage");
    Route::get("extraImage/add",[ExtraImageController::class,"add"])->name("extraImage.add");
    Route::get("extraImage/add/{page}",[ExtraImageController::class,"add"])->name("extraImage.add.page");
    Route::post("extraImage/add",[ExtraImageController::class,"create"])->name("extraImage.add");
    Route::get("extraImage/edit/{id}",[ExtraImageController::class,"edit"])->name("extraImage.edit");
    Route::post("extraImage/edit/{id}",[ExtraImageController::class,"update"])->name("extraImage.update");
    Route::get("extraImage/delete/{id}",[ExtraImageController::class,"delete"])->name("extraImage.delete");

    // Projects (admin CRUD)
    Route::get("projects",[ProjectController::class,"index"])->name("projects.index");
    Route::get("projects/create",[ProjectController::class,"create"])->name("projects.create");
    Route::post("projects",[ProjectController::class,"store"])->name("projects.store");
    Route::get("projects/{id}/edit",[ProjectController::class,"edit"])->name("projects.edit");
    Route::post("projects/{id}",[ProjectController::class,"update"])->name("projects.update");
    Route::post("projects/{id}/delete",[ProjectController::class,"destroy"])->name("projects.delete");
});